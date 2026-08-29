<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call(CompanySeeder::class);
        $this->call(clients::class);
        $this->call(ContractTypeSeeder::class);
        $this->call(ContractTermSeeder::class);
    }
}
