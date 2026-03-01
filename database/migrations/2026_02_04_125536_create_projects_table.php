<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            
            $table->string('name');
            $table->enum('project_type', ['SOLAR', 'BESS', 'SOLAR_BESS', 'OTHER'])->default('OTHER');
            $table->decimal('capacity_mw', 8, 2)->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
            
            // Onboarding workflow
            $table->integer('current_step')->default(1);
            $table->timestamp('qr_expires_at')->nullable();
            
            // Step 1: NDA Signing
            $table->longText('nda_signature')->nullable(); // Base64 signature
            $table->timestamp('nda_signed_at')->nullable();
            
            // Step 2: Inception Meeting
            $table->timestamp('inception_completed_at')->nullable();
            
            // Step 3: RFQ Documentation
            $table->json('rfq_data')->nullable(); // Store form data as JSON
            $table->timestamp('rfq_completed_at')->nullable();
            
            $table->foreignId('client_company_id')
                  ->nullable()
                  ->constrained('companies')
                  ->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['uuid', 'current_step']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};