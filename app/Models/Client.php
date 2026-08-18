<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'commercial_registration',
        'address',
        'email',
        'phone',
        'manager_name',
        'signed_status',
        'otp_code',
        'otp_expires_at'
    ];

    protected $casts = [
        'otp_expires_at' => 'datetime',
    ];

    public function isSigned(): bool
    {
        return $this->signed_status === 'signed';
    }

    public function generateOTP(): string
    {
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->update([
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10)
        ]);
        return $otp;
    }

    public function verifyOTP(string $otp): bool
    {
        if (!$this->otp_code || !$this->otp_expires_at) {
            return false;
        }

        if ($this->otp_expires_at < now()) {
            return false;
        }

        return $this->otp_code === $otp;
    }
}
