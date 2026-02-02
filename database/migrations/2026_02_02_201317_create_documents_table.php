<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->enum('document_type', ['NDA', 'CONTRACT', 'AMENDMENT']);
            $table->string('title');

            // Who initiated / owns the document conceptually
            $table->foreignId('created_by_company_id')
                  ->constrained('companies')
                  ->restrictOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->index('document_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
