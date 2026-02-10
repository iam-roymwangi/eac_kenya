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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('nda_signer_name')->nullable()->after('nda_signed_at');
            $table->string('nda_signer_company')->nullable()->after('nda_signer_name');
            $table->string('nda_signer_position')->nullable()->after('nda_signer_company');
            $table->string('nda_signer_email')->nullable()->after('nda_signer_position');
            $table->string('nda_signer_phone')->nullable()->after('nda_signer_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'nda_signer_name',
                'nda_signer_company',
                'nda_signer_position',
                'nda_signer_email',
                'nda_signer_phone'
            ]);
        });
    }
};
