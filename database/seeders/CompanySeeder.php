<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::query()->updateOrCreate(
            ['name' => 'مؤسسة آمر تم لخدمات الأعمال'],
            [
                'commercial_registration' => '7036125610',
                'address' => 'جدة، حي الحمراء، شارع فلسطين، مركز الجمجوم التجاري',
                'email' => 'info@amrtm.com.sa',
                'phone' => '920002164',
                'manager_name' => 'صالح بن ناصر الشمراني',
            ]
        );
    }
}
