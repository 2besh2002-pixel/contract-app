<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clause;

class ClauseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clauses = [
            'يلتزم الطرف الثاني بتقديم جميع المستندات المطلوبة خلال المدة المحددة.',
            'تحتفظ المؤسسة بحقها في إنهاء العقد في حال الإخلال بأي من البنود.',
            'يسري هذا العقد من تاريخ التوقيع عليه من الطرفين.',
            // ضيف باقي البنود هنا
        ];

        foreach ($clauses as $index => $text) {
            Clause::create([
                'content' => $text,
                'order' => $index + 1,
            ]);
        }
    }
}
