<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contract_attachments', function (Blueprint $table) {
            $table->string('document_type', 40)->default('other')->after('original_name');
        });
    }

    public function down(): void
    {
        Schema::table('contract_attachments', function (Blueprint $table) {
            $table->dropColumn('document_type');
        });
    }
};
