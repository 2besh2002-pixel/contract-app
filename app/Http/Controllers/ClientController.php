<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        // Validate input with strict type checking
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255'
            ],
            'commercial_registration' => [
                'nullable',
                'string',
                'min:5',
                'max:255'
            ],
            'address' => [
                'nullable',
                'string',
                'min:5',
                'max:255'
            ],
            'email' => [
                'nullable',
                'email',
                'max:255'
            ],
            'phone' => [
                'nullable',
                'string',
                'regex:/^\d{9,}$/' // At least 9 digits
            ],
            'manager_name' => [
                'nullable',
                'string',
                'min:3',
                'max:255'
            ],
        ], [
            'name.required' => 'اسم المنشأة مطلوب',
            'name.min' => 'اسم المنشأة يجب أن يكون 3 أحرف على الأقل',
            'commercial_registration.min' => 'رقم السجل التجاري يجب أن يكون 5 أحرف على الأقل',
            'address.min' => 'العنوان يجب أن يكون 5 أحرف على الأقل',
            'email.email' => 'البريد الإلكتروني غير صحيح',
            'phone.regex' => 'رقم الجوال يجب أن يكون 9 أرقام على الأقل',
            'manager_name.min' => 'اسم المدير العام يجب أن يكون 3 أحرف على الأقل',
        ]);

        // Additional type checking
        if (!is_string($validated['name'])) {
            return response()->json([
                'success' => false,
                'message' => 'نوع البيانات غير صحيح'
            ], 422);
        }

        // Check if client with same registration exists
        $client = Client::where('commercial_registration', $validated['commercial_registration'] ?? '')
            ->first();

        if ($client) {
            // Update existing client
            $client->update($validated);
        } else {
            // Create new client
            $client = Client::create($validated);
        }

        // Return JSON response if it's an AJAX request
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حفظ بيانات الطرف الثاني بنجاح',
                'client_id' => $client->id
            ]);
        }

        return redirect()->back()->with('success', 'تم حفظ بيانات الطرف الثاني بنجاح');
    }
}
