<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_number')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedTinyInteger('duration_years')->default(1);
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedBigInteger('contract_type_id')->nullable();
            $table->timestamps();

            $table->foreign('contract_type_id')->references('id')->on('contract_types')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
