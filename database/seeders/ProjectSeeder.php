<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create the specific "DevPulse" project manually
        $devPulse = Project::create([
            'title' => 'DevPulse',
            'slug' => 'devpulse',
            'description' => 'A high-performance portfolio ecosystem.',
            'tech_stack' => ['Laravel', 'Next.js', 'PostgreSQL', 'React js', 'Typescript'],
            'is_featured' => true,
            'order' => 1,
        ]);

        $devPulse->detail()->create([
            'problem_statement' => 'Standard portfolios are often static, slow to update, and fail to demonstrate complex full-stack architecture.',
            'solution_approach' => 'Architected a decoupled system using Laravel 11 as a headless API and Next.js 15 for the frontend. Implemented ISR for sub-second page loads and PostgreSQL JSONB for flexible project metadata.',
            'repository_links' => [
                'frontend' => 'https://github.com/your-username/devpulse-ui',
                'backend' => 'https://github.com/your-username/devpulse-api'
            ],
            'feature_highlights' => [
                'Decoupled Architecture',
                'Next.js 15 Async Routing',
                'PostgreSQL JSONB Integration',
                'Incremental Static Regeneration (ISR)'
            ],
            'live_url' => 'https://devpulse.ca'
        ]);

        // 2. Create 10 additional random projects with details for layout testing
        Project::factory()
            ->count(10)
            ->hasDetail()
            ->create();
    }
}
