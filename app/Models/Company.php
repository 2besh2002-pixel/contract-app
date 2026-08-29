<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'commercial_registration',
        'address',
        'email',
        'phone',
        'manager_name',
    ];
    public function contracts()
    {
        return $this->hasMany(Contract::class, 'first_party_id');
    }
}
