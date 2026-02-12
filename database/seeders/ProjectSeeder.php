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
            'description' => 'A production-grade full-stack ecosystem leveraging a decoupled architecture and containerized cloud deployment.',
            'thumbnail_url' => 'https://devpulse-assets.s3.us-east-1.amazonaws.com/DevPulse.png',
            'tech_stack' => ['Laravel 12', 'PHP 8.4', 'Next.js 15', 'PostgreSQL', 'Docker', 'AWS ECS', 'Tailwind CSS'],
            'is_featured' => true,
            'order' => 1,
        ]);

        $devPulse->detail()->create([
            'problem_statement' => 'Many developer portfolios lack real-world infrastructure, failing to demonstrate the ability to manage complex deployment pipelines, containerization, and cloud-native databases.',
            'solution_approach' => 'Built a high-performance system using Laravel 12 as a headless API and Next.js 15. The backend is containerized via a custom multi-stage Docker build (Alpine Linux + Nginx + PHP 8.4-FPM) and deployed to AWS ECS Fargate, supported by an RDS PostgreSQL instance.',
            'repository_links' => [
                'frontend' => 'https://github.com/saqibbilal/devpulse-ui',
                'backend' => 'https://github.com/saqibbilal/devpulse-api'
            ],
            'feature_highlights' => [
                'Multi-stage Docker Builds (Optimized < 200MB)',
                'AWS ECR/ECS Fargate Deployment Pipeline',
                'Headless CMS Architecture with JSONB Metadata',
                'Automated Deployment via Idempotent Shell Scripts',
                'Process Management with Supervisor in Alpine Linux'
            ],
            'live_url' => 'https://mbilal.ca/'
        ]);

        // 2. Create the TaskFlow project manually
        $taskFlow = Project::create([
            'title' => 'TaskFlow',
            'slug' => 'taskflow',
            'description' => 'A containerized full-stack ecosystem demonstrating high-performance communication between a headless Laravel API and a Next.js SSR frontend.',
            'thumbnail_url' => 'https://devpulse-assets.s3.us-east-1.amazonaws.com/TaskFlow.png',
            'tech_stack' => ['Laravel 12', 'PHP 8.4', 'Next.js 15', 'PostgreSQL', 'Docker', 'AWS App Runner', 'AWS ECR'],
            'is_featured' => true,
            'order' => 1,
        ]);

        $taskFlow->detail()->create([
            'problem_statement' => 'Bridging the gap between traditional PHP backends and modern JavaScript frontends often results in deployment friction, especially regarding environment variables and SSR networking.',
            'solution_approach' => 'Architected a monorepo utilizing Docker multi-stage builds. Implemented Next.js Standalone mode to optimize for cloud deployment on AWS App Runner. The backend serves as a headless API, while the frontend handles complex server-side data fetching with absolute URL resolution.',
            'repository_links' => [
                'monorepo' => 'https://github.com/saqibbilal/taskflow',
            ],
            'feature_highlights' => [
                'Next.js Standalone Mode Image Optimization',
                'Docker Build-Arg Variable Injection',
                'Asynchronous UI Updates with useTransition',
                'AWS App Runner & ECR Deployment Pipeline',
                'Automated Database Migrations via RDS'
            ],
            'live_url' => 'https://taskflow-frontend-beta.vercel.app/' // You can update this to your resume link
        ]);
    }
}
