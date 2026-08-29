<?php

namespace Database\Seeders;

use App\Models\ContractType;
use Illuminate\Database\Seeder;

class ContractTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'عقد استشارات',    'price' => 1500.00],
            ['name' => 'عقد خدمة محددة', 'price' => 2000.00],
            ['name' => 'عقد سنوي',        'price' => 2500.00],
        ];

        foreach ($types as $type) {
            ContractType::query()->firstOrCreate(
                ['name' => $type['name']],
                ['price' => $type['price']]
            );
        }
    }
}
