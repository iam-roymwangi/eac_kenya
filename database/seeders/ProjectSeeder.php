<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample projects for testing onboarding
        Project::create([
            'uuid' => Str::uuid(),
            'name' => 'Kimuka 2 Solar Project',
            'description' => '40MW Solar PV project with integrated Battery Energy Storage System (BESS) located in Kimuka, Kenya. This project aims to provide clean, reliable renewable energy to the national grid while supporting local economic development.',
            'project_type' => 'SOLAR_BESS',
            'capacity_mw' => 40.00,
            'location' => 'Kimuka, Kenya',
            'current_step' => 1,
            'qr_expires_at' => now()->addHours(48),
        ]);

        Project::create([
            'uuid' => Str::uuid(),
            'name' => 'Nyakwere Hills Solar Project',
            'description' => '40MW Solar PV installation with Battery Energy Storage System in Nyakwere Hills region. This project focuses on sustainable energy generation with advanced storage capabilities for grid stability.',
            'project_type' => 'SOLAR_BESS',
            'capacity_mw' => 40.00,
            'location' => 'Nyakwere Hills, Kenya',
            'current_step' => 1,
            'qr_expires_at' => now()->addHours(48),
        ]);

        Project::create([
            'uuid' => Str::uuid(),
            'name' => 'Mombasa Industrial Solar',
            'description' => '25MW Solar PV project designed for industrial applications in the Mombasa region. Focus on providing reliable daytime power for manufacturing facilities.',
            'project_type' => 'SOLAR',
            'capacity_mw' => 25.00,
            'location' => 'Mombasa, Kenya',
            'current_step' => 1,
            'qr_expires_at' => now()->addHours(48),
        ]);
    }
}