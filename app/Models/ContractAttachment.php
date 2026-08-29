<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'original_name',
        'document_type',
        'path',
        'mime_type',
        'size',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
