<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    protected $fillable = ['name', 'price'];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
