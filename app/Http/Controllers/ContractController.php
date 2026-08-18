<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Client;
use App\Models\ContractType;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContractController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'contract_type_id' => ['required', 'exists:contract_types,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'duration_years' => ['required', 'integer', 'min:1'],
            'price' => ['nullable', 'numeric'],
        ]);

        $contractType = ContractType::findOrFail($data['contract_type_id']);
        $data['price'] = $contractType->price;
        $data['duration_years'] = 1;

        $contractNumber = Contract::generateNextContractNumber();
        $data['contract_number'] = $contractNumber;

        $contract = Contract::create($data);

        return redirect()->back()->with('success', 'تم حفظ العقد بنجاح برقم: ' . $contract->contract_number);
    }

    /**
     * Show signature verification page
     */
    public function showSignatureVerification(Client $client)
    {
        // Validate that client exists and has a phone number
        if (!$client->phone) {
            return redirect()->route('contracts.create')
                ->with('error', 'الرجاء تحديث رقم جوال الطرف الثاني أولاً');
        }

        // Generate and send OTP
        $otp = $client->generateOTP();

        // TODO: Send OTP via SMS
        // Example: SMS::send($client->phone, "رمز التحقق الخاص بك: $otp");

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
            ]
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

        return response()->json([
            'message' => 'تم التحقق بنجاح',
            'redirect_url' => route('contracts.create')
        ]);
    }

    /**
     * Resend OTP
     */
    public function resendOTP(Request $request, Client $client)
    {
        // Validate that client has a phone number
        if (!$client->phone) {
            return response()->json([
                'message' => 'الرجاء تحديث رقم جوال الطرف الثاني أولاً'
            ], 422);
        }

        // Generate new OTP
        $otp = $client->generateOTP();

        // TODO: Send OTP via SMS
        // Example: SMS::send($client->phone, "رمز التحقق الخاص بك: $otp");

        return response()->json([
            'message' => 'تم إعادة إرسال الرمز'
        ]);
    }
}
