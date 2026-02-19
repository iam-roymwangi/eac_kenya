<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample projects for testing onboarding (only if they don't exist)
        $projects = [
            [
                'name' => 'Kimuka 2 Solar Project',
                'description' => '40MW Solar PV project with integrated Battery Energy Storage System (BESS) located in Kimuka, Kenya. This project aims to provide clean, reliable renewable energy to the national grid while supporting local economic development.',
                'project_type' => 'SOLAR_BESS',
                'capacity_mw' => 40.00,
                'location' => 'Kimuka, Kenya',
            ],
            [
                'name' => 'Nyakwere Hills Solar Project',
                'description' => '40MW Solar PV installation with Battery Energy Storage System in Nyakwere Hills region. This project focuses on sustainable energy generation with advanced storage capabilities for grid stability.',
                'project_type' => 'SOLAR_BESS',
                'capacity_mw' => 40.00,
                'location' => 'Nyakwere Hills, Kenya',
            ],
            [
                'name' => 'Ol Ndanyat Wind Power Project',
                'description' => '65MW Wind Power project located in Kona Baridi, Kajiado County. This project harnesses consistent wind patterns in the region to provide clean, renewable energy to the national grid.',
                'project_type' => 'WIND',
                'capacity_mw' => 65.00,
                'location' => 'Kona Baridi, Kajiado, Kenya',
            ],
        ];

        foreach ($projects as $projectData) {
            Project::firstOrCreate(
                ['name' => $projectData['name']],
                array_merge($projectData, [
                    'uuid' => Str::uuid(),
                    'current_step' => 1,
                    'qr_expires_at' => now()->addHours(48),
                ])
            );
        }
    }
}