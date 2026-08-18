<?php

namespace Tests\Feature;

use App\Models\Contract;
use App\Models\ContractType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContractNumberGenerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_a_unique_contract_number_with_cnt_prefix(): void
    {
        ContractType::firstOrCreate(['name' => 'سنوي']);

        $number = Contract::generateNextContractNumber();

        $this->assertMatchesRegularExpression('/^CNT-\d{4}-\d{4,}$/', $number);

        $this->assertDatabaseMissing('contracts', [
            'contract_number' => $number,
        ]);

        Contract::create([
            'contract_number' => $number,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addYear()->toDateString(),
            'duration_years' => 1,
            'contract_type_id' => ContractType::first()->id,
        ]);

        $this->assertDatabaseHas('contracts', [
            'contract_number' => $number,
        ]);

        $anotherNumber = Contract::generateNextContractNumber();

        $this->assertNotSame($number, $anotherNumber);
        $this->assertStringStartsWith('CNT-', $anotherNumber);
    }
}
