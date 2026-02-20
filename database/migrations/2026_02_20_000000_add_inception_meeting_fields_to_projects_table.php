<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Preferred / scheduled inception meeting details
            $table->enum('inception_meeting_mode', ['online', 'physical'])
                  ->nullable()
                  ->after('inception_completed_at');

            $table->timestamp('inception_meeting_scheduled_at')
                  ->nullable()
                  ->after('inception_meeting_mode');

            $table->string('inception_meeting_location')
                  ->nullable()
                  ->after('inception_meeting_scheduled_at');

            $table->string('inception_meeting_link')
                  ->nullable()
                  ->after('inception_meeting_location');

            $table->text('inception_meeting_notes')
                  ->nullable()
                  ->after('inception_meeting_link');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'inception_meeting_mode',
                'inception_meeting_scheduled_at',
                'inception_meeting_location',
                'inception_meeting_link',
                'inception_meeting_notes',
            ]);
        });
    }
};

