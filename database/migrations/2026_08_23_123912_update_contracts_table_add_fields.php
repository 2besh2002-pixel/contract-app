<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreignId('first_party_id')
                ->nullable()
                ->after('contract_number')
                ->constrained('companies')
                ->nullOnDelete();
            $table->foreignId('second_party_id')
                ->nullable()
                ->after('first_party_id')
                ->constrained('clients')
                ->nullOnDelete();
            $table->text('terms')->nullable()->after('end_date');
            $table->enum('status', ['active', 'expired', 'cancelled', 'pending'])
                ->default('active')
                ->after('terms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropForeign(['first_party_id']);
            $table->dropForeign(['second_party_id']);
            $table->dropColumn(['first_party_id', 'second_party_id', 'terms', 'status']);
        });
    }
};
