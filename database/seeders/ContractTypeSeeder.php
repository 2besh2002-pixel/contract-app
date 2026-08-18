<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    public function run(): void
    {
        ContractType::query()->firstOrCreate(
            ['name' => 'سنوي'],
            ['price' => 2500.00]
        );
    }
}
