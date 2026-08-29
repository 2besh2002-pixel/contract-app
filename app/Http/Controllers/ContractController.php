<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Client;
use App\Models\Company;
use App\Models\ContractTerm;
use App\Models\ContractType;
use App\Models\ContractAttachment;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;


class ContractController extends Controller
{
    public function create()
    {
        try {
            $company = Company::first();
            $contractTerms = ContractTerm::orderBy('id')->get();
            $client = Client::where('name', 'شركة العمارة الزرقاء المحدودة')->first();
            $contractTypes = Schema::hasTable('contract_types') ? ContractType::all() : collect();
        } catch (\Throwable $e) {
            report($e);
            $company = null;
            $contractTerms = collect();
            $client = null;
            $contractTypes = collect();
        }

        return view('contracts.create', [
            'company' => $company,
            'client' => $client,
            'clients' => $client ? collect([$client]) : collect(),
            'contract' => null,
            'contractTerms' => $contractTerms,
            'contractTypes' => $contractTypes,
            'defaultStartDate' => now()->toDateString(),
            'defaultEndDate' => now()->addYear()->toDateString(),
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'contract_type_id' => ['required', 'exists:contract_types,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'duration_years' => ['required', 'integer', 'min:1'],
            'price' => ['nullable', 'numeric'],
            'client_id' => ['required', 'exists:clients,id'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'attachment_types' => ['nullable', 'array'],
            'attachment_types.*' => ['required', 'string', 'in:commercial_registration,license,identity,other'],
        ]);

        $contractType = ContractType::findOrFail($data['contract_type_id']);
        $data['price'] = $contractType->price;
        $data['duration_years'] = 1;
        $data['first_party_id'] = Company::first()?->id;
        $data['terms'] = $this->contractTermsText();

        $contractNumber = Contract::generateNextContractNumber();
        $data['contract_number'] = $contractNumber;

        $storedPaths = [];

        try {
            $contract = DB::transaction(function () use ($data, $request, &$storedPaths) {
                $data['second_party_id'] = $data['client_id'];
                unset($data['client_id']);
                $data['status'] = 'pending';
                $data['signature_status'] = 'pending';
                $data['payment_status'] = 'unpaid';
                $contract = Contract::create($data);

                foreach ($request->file('attachments', []) as $index => $attachment) {
                    $path = $attachment->store('contracts/' . $contract->id, 'private');
                    $storedPaths[] = $path;

                    ContractAttachment::create([
                        'contract_id' => $contract->id,
                        'original_name' => $attachment->getClientOriginalName(),
                        'document_type' => $data['attachment_types'][$index] ?? 'other',
                        'path' => $path,
                        'mime_type' => $attachment->getMimeType(),
                        'size' => $attachment->getSize(),
                    ]);
                }

                return $contract;
            });
        } catch (\Throwable $exception) {
            foreach ($storedPaths as $path) {
                Storage::disk('private')->delete($path);
            }

            throw $exception;
        }

        return redirect()->back()->with('success', 'تم حفظ العقد بنجاح برقم: ' . $contract->contract_number);
    }

    public function uploadAttachments(Request $request, Contract $contract)
    {
        $data = $request->validate([
            'attachments' => ['required', 'array', 'min:1'],
            'attachments.*' => ['file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'attachment_types' => ['required', 'array', 'size:' . count($request->file('attachments', []))],
            'attachment_types.*' => ['required', 'string', 'in:commercial_registration,license,identity,other'],
        ]);

        $storedPaths = [];

        try {
            DB::transaction(function () use ($data, $request, $contract, &$storedPaths) {
                foreach ($request->file('attachments', []) as $index => $attachment) {
                    $path = $attachment->store('contracts/' . $contract->id, 'private');
                    $storedPaths[] = $path;

                    ContractAttachment::create([
                        'contract_id' => $contract->id,
                        'original_name' => $attachment->getClientOriginalName(),
                        'document_type' => $data['attachment_types'][$index],
                        'path' => $path,
                        'mime_type' => $attachment->getMimeType(),
                        'size' => $attachment->getSize(),
                    ]);
                }
            });
        } catch (\Throwable $exception) {
            foreach ($storedPaths as $path) {
                Storage::disk('private')->delete($path);
            }

            throw $exception;
        }

        return response()->json(['message' => 'تم حفظ المرفقات بنجاح']);
    }

    /**
     * Show signature verification page
     */
    public function showSignatureVerification(Client $client)
    {
        // Validate that client exists and has an email address
        if (!$client->email) {
            return redirect()->route('contracts.create')
                ->with('error', 'الرجاء تحديث بريد الطرف الثاني أولاً');
        }

        // Keep the current code valid when the page is refreshed.
        if (!$client->otp_code || !$client->otp_expires_at || $client->otp_expires_at->isPast()) {
            $client->generateOTP();
        }

        return view('contracts.verify-signature', [
            'client' => $client
        ]);
    }

    /**
     * Verify OTP and update signature status
     */
    public function verifyOTP(Request $request, Client $client)
    {
        // Validate input with type checking
        $validated = $request->validate([
            'otp_code' => [
                'required',
                'string',
                'size:6',
                'regex:/^\d+$/' // Only digits
            ],
            'contract_type_id' => ['required', 'exists:contract_types,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'duration_years' => ['required', 'integer', 'min:1'],
        ], [
            'otp_code.required' => 'رمز التحقق مطلوب',
            'otp_code.size' => 'رمز التحقق يجب أن يكون 6 أرقام',
            'otp_code.regex' => 'رمز التحقق يجب أن يحتوي على أرقام فقط'
        ]);

        // Type checking
        if (!is_string($validated['otp_code']) || strlen($validated['otp_code']) !== 6) {
            return response()->json([
                'message' => 'رمز التحقق غير صحيح'
            ], 422);
        }

        // Verify OTP
        if (!$client->verifyOTP($validated['otp_code'])) {
            return response()->json([
                'message' => 'رمز التحقق غير صحيح أو انتهت صلاحيته'
            ], 422);
        }

        // Update client signature status
        $client->update([
            'signed_status' => 'signed',
            'otp_code' => null,
            'otp_expires_at' => null
        ]);

        $contractType = ContractType::findOrFail($validated['contract_type_id']);
        $contract = Contract::create([
            'contract_number' => Contract::generateNextContractNumber(),
            'first_party_id' => Company::first()?->id,
            'second_party_id' => $client->id,
            'contract_type_id' => $contractType->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'duration_years' => $validated['duration_years'],
            'terms' => $this->contractTermsText(),
            'price' => $contractType->price,
            'status' => 'active',
            'signature_status' => 'signed',
            'payment_status' => 'unpaid',
            'signed_at' => now(),
        ]);

        return response()->json([
            'message' => 'تم التحقق بنجاح',
            'contract_id' => $contract->id,
            'contract_number' => $contract->contract_number,
            'redirect_url' => route('contracts.create')
        ]);
    }

    private function contractTermsText(): ?string
    {
        $terms = ContractTerm::orderBy('id')->get()
            ->map(function (ContractTerm $term): string {
                return $term->contract_term_description
                    ? $term->contract_term_name . ': ' . $term->contract_term_description
                    : $term->contract_term_name;
            });

        return $terms->isEmpty() ? null : $terms->implode("\n");
    }

    /**
     * Resend OTP
     */
    public function resendOTP(Request $request, Client $client)
    {
        // Validate that client has an email address
        if (!$client->email) {
            return response()->json([
                'message' => 'الرجاء تحديث بريد الطرف الثاني أولاً'
            ], 422);
        }

        // Generate new OTP
        $otp = $client->generateOTP();

        if (!config('services.resend.key')) {
            return response()->json([
                'message' => 'مفتاح Resend غير مضبوط في ملف .env.'
            ], 503);
        }

        try {
            $response = Http::withToken(config('services.resend.key'))
                ->acceptJson()
                ->timeout(15)
                ->post('https://api.resend.com/emails', [
                    'from' => config('services.resend.from'),
                    'to' => [$client->email],
                    'subject' => 'رمز التحقق من توقيع العقد',
                    'html' => '<div dir="rtl"><h2>رمز التحقق</h2><p>رمز التحقق الخاص بك هو:</p><h1>' . e($otp) . '</h1><p>ينتهي الرمز خلال 10 دقائق.</p></div>',
                ]);

            if ($response->failed()) {
                $message = $response->json('message') ?: 'رفض Resend طلب إرسال البريد.';
                report(new \RuntimeException('Resend email failed: ' . $message));

                return response()->json([
                    'message' => $message
                ], $response->status() >= 400 ? $response->status() : 502);
            }
        } catch (ConnectionException | RequestException $exception) {
            report($exception);

            return response()->json([
                'message' => 'تعذر إرسال رمز التحقق إلى البريد الإلكتروني. تحقق من إعدادات Resend.'
            ], 502);
        }

        return response()->json([
            'message' => 'تم إرسال رمز التحقق إلى البريد الإلكتروني'
        ]);
    }
}
