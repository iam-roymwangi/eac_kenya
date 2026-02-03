<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_signatures', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('document_version_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('company_representative_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('role', ['SIGNATORY', 'WITNESS']);

            $table->timestamp('signed_at');
            $table->string('signature_hash', 64);
            $table->string('ip_address')->nullable();

            $table->timestamps();

            $table->unique(
                ['document_version_id', 'company_representative_id', 'role'],
                'doc_sigs_ver_rep_role_unique' // Custom name (under 64 chars)
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
};
