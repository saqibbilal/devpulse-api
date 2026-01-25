<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Support\Str;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. POPULATE SKILLS (With Order field)
        $skills = [
            // Backend
            ['name' => 'PHP 8.3 (Expert)', 'category' => 'backend', 'order' => 1],
            ['name' => 'Laravel 11 (Headless)', 'category' => 'backend', 'order' => 2],
            ['name' => 'RESTful API Design', 'category' => 'backend', 'order' => 3],
            ['name' => 'PostgreSQL & MySQL', 'category' => 'backend', 'order' => 4],
            ['name' => 'Redis & Memcached', 'category' => 'backend', 'order' => 5],

            // Frontend
            ['name' => 'TypeScript (Enterprise)', 'category' => 'frontend', 'order' => 1],
            ['name' => 'Next.js 15', 'category' => 'frontend', 'order' => 2],
            ['name' => 'React', 'category' => 'frontend', 'order' => 3],
            ['name' => 'Tailwind CSS', 'category' => 'frontend', 'order' => 4],

            // Tools
            ['name' => 'AWS (App Runner, S3, RDS)', 'category' => 'tools', 'order' => 1],
            ['name' => 'Docker & Docker Compose', 'category' => 'tools', 'order' => 2],
            ['name' => 'GitHub Actions (CI/CD)', 'category' => 'tools', 'order' => 3],
            ['name' => 'TDD (PHPUnit/Vitest)', 'category' => 'tools', 'order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 2. POPULATE PROJECTS (Using your specific Model fields)
        $projects = [
            [
                'title' => 'Decoupled Ecosystem Architecture',
                'description' => 'Architected a headless Laravel 11 API with a Next.js 15 frontend using strict TypeScript enforcement for enterprise standards[cite: 50, 51].',
                'tech_stack' => ['Laravel 11', 'Next.js 15', 'TypeScript', 'Tailwind CSS'],
                'is_featured' => true,
                'order' => 1,
                'thumbnail_url' => 'https://via.placeholder.com/600x400?text=Decoupled+Architecture'
            ],
            [
                'title' => 'Financial Integration Engine',
                'description' => 'Modernized payment infrastructure using Stripe API and Laravel Cashier for automated billing and invoicing logic[cite: 58, 101].',
                'tech_stack' => ['Stripe API', 'Laravel Cashier', 'PHP 8.3', 'Docker'],
                'is_featured' => true,
                'order' => 2,
                'thumbnail_url' => 'https://via.placeholder.com/600x400?text=Financial+Systems'
            ],
            [
                'title' => 'Fraud Detection & Optimization',
                'description' => 'Reduced page load times by 40% through MySQL indexing and engineered cookie-based tracking to prevent fraudulent accounts[cite: 62, 63].',
                'tech_stack' => ['MySQL', 'PHP', 'Security Engineering', 'Performance Tuning'],
                'is_featured' => false,
                'order' => 3,
                'thumbnail_url' => 'https://via.placeholder.com/600x400?text=Performance+Optimization'
            ],
            [
                'title' => 'Real Estate Sync Service',
                'description' => 'Integrated complex third-party REST APIs including Google Maps and Calendar for real-estate data synchronization[cite: 68, 117].',
                'tech_stack' => ['REST APIs', 'AWS S3', 'Laravel', 'Google Maps API'],
                'is_featured' => false,
                'order' => 4,
                'thumbnail_url' => 'https://via.placeholder.com/600x400?text=Cloud+Integrations'
            ]
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                array_merge($project, ['slug' => Str::slug($project['title'])])
            );
        }
    }
}
