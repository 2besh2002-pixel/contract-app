<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'start_date',
        'end_date',
        'duration_years',
        'contract_type_id',
        'price',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
        'price' => 'decimal:2',
    ];

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }

    public static function generateNextContractNumber(): string
    {
        $year = now()->format('Y');
        $lastContract = self::orderByDesc('id')->first();

        if (! $lastContract || empty($lastContract->contract_number)) {
            return 'CNT-' . $year . '-' . '0001';
        }

        preg_match('/^CNT-(\d{4})-(\d+)$/', $lastContract->contract_number, $matches);

        if (! $matches) {
            return 'CNT-' . $year . '-' . '0001';
        }

        $lastYear = $matches[1];
        $lastSequence = (int) $matches[2];

        if ((int) $year !== (int) $lastYear) {
            return 'CNT-' . $year . '-' . '0001';
        }

        return 'CNT-' . $year . '-' . str_pad((string) ($lastSequence + 1), 4, '0', STR_PAD_LEFT);
    }
}
