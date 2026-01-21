<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the specific "DevPulse" project manually to ensure slug accuracy
        $devPulse = \App\Models\Project::create([
            'title' => 'DevPulse',
            'slug' => 'devpulse',
            'description' => 'A high-performance portfolio ecosystem.',
            'tech_stack' => ['Laravel', 'Next.js', 'PostgreSQL', 'React js' ,'Typescript'],
            'is_featured' => true,
            'order' => 1,
        ]);

        $devPulse->detail()->create([
            'problem_statement' => 'Standard portfolios are static.',
            'repository_links' => ['frontend' => '...', 'backend' => '...'],
            'feature_highlights' => ['ISR', 'PostgreSQL JSONB'],
            'live_url' => 'https://devpulse.ca'
        ]);

        // 2. Create 10 additional random projects with details for layout testing
        \App\Models\Project::factory()
            ->count(10)
            ->hasDetail() // This looks for a 'detail' relationship on the Project model
            ->create();
    }
}
