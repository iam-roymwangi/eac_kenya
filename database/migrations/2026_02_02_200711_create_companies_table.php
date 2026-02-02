<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->enum('company_type', ['EAC', 'CLIENT', 'INVESTOR']);

            $table->string('registration_number')->nullable();
            $table->string('country', 100)->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Optional but smart
            $table->index('company_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
