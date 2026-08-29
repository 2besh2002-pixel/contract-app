<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('contract_terms')) {
            Schema::table('contract_terms', function (Blueprint $table) {
                $table->text('contract_term_description')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('contract_terms')) {
            Schema::table('contract_terms', function (Blueprint $table) {
                $table->string('contract_term_description')->nullable()->change();
            });
        }
    }
};
