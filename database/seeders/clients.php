<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class clients extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'شركة العمارة الزرقاء المحدودة',
                'commercial_registration' => '4030447380',
                'address' => 'جدة حي الحمرا شارع فلسطين 2724 الرمز 23321',
                'email' => '2besh2002@gmail.com',
                'phone' => '0565188088',
                'manager_name' => 'محمد بن محفوظ عشميل',
            ],
        ];

        foreach ($clients as $client) {
            DB::table('clients')->updateOrInsert(
                ['commercial_registration' => $client['commercial_registration']],
                $client
            );
        }
    }
}
