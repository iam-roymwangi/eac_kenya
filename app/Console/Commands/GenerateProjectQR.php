<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\URL;

class GenerateProjectQR extends Command
{
    protected $signature = 'project:generate-qr {project_uuid} {--hours=48}';
    protected $description = 'Generate a signed QR code URL for project onboarding';

    public function handle()
    {
        $uuid = $this->argument('project_uuid');
        $hours = (int) $this->option('hours');
        
        $project = Project::where('uuid', $uuid)->first();
        
        if (!$project) {
            $this->error("Project with UUID {$uuid} not found.");
            return 1;
        }
        
        // Update expiration time
        $expiresAt = now()->addHours($hours);
        $project->update(['qr_expires_at' => $expiresAt]);
        
        // Generate signed URL
        $signedUrl = URL::temporarySignedRoute(
            'onboarding.step-one',
            $expiresAt,
            ['uuid' => $uuid]
        );
        
        $this->info("QR Code URL generated for project: {$project->name}");
        $this->info("URL: {$signedUrl}");
        $this->info("Expires: {$expiresAt->format('Y-m-d H:i:s')}");
        
        // Display QR code instructions
        $this->newLine();
        $this->info("To generate a QR code:");
        $this->info("1. Use any QR code generator service");
        $this->info("2. Input the URL above");
        $this->info("3. Print or share the QR code with the client");
        
        return 0;
    }
}