<?php

use App\Http\Controllers\ContractController;
use App\Models\Clause;
use App\Models\Company;
use App\Models\ContractType;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contract-form', function () {
    $company = Company::first();
    $clauses = Clause::orderBy('order')->get();
    $contractTypes = Schema::hasTable('contract_types') ? ContractType::all() : collect();

    return view('contracts.create', [
        'company' => $company,
        'contract' => null,
        'clauses' => $clauses,
        'contractTypes' => $contractTypes,
        'defaultStartDate' => now()->toDateString(),
        'defaultEndDate' => now()->addYear()->toDateString(),
    ]);
})->name('contracts.create');

Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::post('/clients', [\App\Http\Controllers\ClientController::class, 'store']);

// Signature verification routes
Route::get('/client/{client}/signature-verification', [ContractController::class, 'showSignatureVerification'])->name('client.signature-verification');
Route::post('/client/{client}/verify-otp', [ContractController::class, 'verifyOTP'])->name('client.verify-otp');
Route::post('/client/{client}/resend-otp', [ContractController::class, 'resendOTP'])->name('client.resend-otp');
