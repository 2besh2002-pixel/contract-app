<?php

use App\Http\Controllers\ContractController;
use App\Models\Company;
use App\Models\ContractType;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
Route::post('/contracts/{contract}/attachments', [ContractController::class, 'uploadAttachments'])
    ->name('contracts.attachments.store');
Route::get('/clients', [ClientController::class, 'store']);

// Signature verification routes
Route::get('/client/{client}/signature-verification', [ContractController::class, 'showSignatureVerification'])->name('client.signature-verification');
Route::post('/client/{client}/verify-otp', [ContractController::class, 'verifyOTP'])->name('client.verify-otp');
Route::post('/client/{client}/resend-otp', [ContractController::class, 'resendOTP'])->name('client.resend-otp');

Route::get('/contract-form', [ContractController::class, 'create'])->name('contracts.create');
Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create.form');
