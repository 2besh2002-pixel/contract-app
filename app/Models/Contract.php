<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public static function generateNextContractNumber(): string
    {
        $year = now()->year;
        $sequence = static::where('contract_number', 'like', "CNT-{$year}-%")
            ->count() + 1;

        do {
            $contractNumber = sprintf('CNT-%d-%04d', $year, $sequence);
            $sequence++;
        } while (static::where('contract_number', $contractNumber)->exists());

        return $contractNumber;
    }

    protected $fillable = [
        'contract_number',
        'first_party_id',
        'second_party_id',
        'contract_type_id',
        'duration_years',
        'start_date',
        'end_date',
        'terms',
        'status',
        'payment_status',
        'price',
        'signature_status',
        'signed_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'signed_at' => 'datetime',
    ];

    public function firstParty()
    {
        return $this->belongsTo(Company::class, 'first_party_id');
    }

    public function secondParty()
    {
        return $this->belongsTo(Client::class, 'second_party_id');
    }

    public function contractType()
    {
        return $this->belongsTo(ContractType::class, 'contract_type_id');
    }

    public function attachments()
    {
        return $this->hasMany(ContractAttachment::class);
    }
}
