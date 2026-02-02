<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_representatives', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Nullable: not every representative needs a login
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('company_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('full_name');
            $table->string('title')->nullable();
            $table->string('email')->nullable();

            // Legal capability flag
            $table->boolean('can_sign')->default(false);

            $table->timestamps();
            $table->softDeletes();

            // Sensible indexes
            $table->index(['company_id', 'can_sign']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_representatives');
    }
};
