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
            ['name' => 'PHP 8.5+', 'category' => 'backend', 'order' => 1],
            ['name' => 'Laravel 12 (Headless)', 'category' => 'backend', 'order' => 2],
            ['name' => 'AI Integration (RAG & Gemini)', 'category' => 'backend', 'order' => 3],
            ['name' => 'PostgreSQL (JSONB & pgvector)', 'category' => 'backend', 'order' => 4],
            ['name' => 'RESTful API Design', 'category' => 'backend', 'order' => 5],

            // Frontend
            ['name' => 'Next.js 15 (App Router)', 'category' => 'frontend', 'order' => 1],
            ['name' => 'TanStack Query (React Query)', 'category' => 'frontend', 'order' => 2],
            ['name' => 'TypeScript', 'category' => 'frontend', 'order' => 3],
            ['name' => 'Axios', 'category' => 'frontend', 'order' => 4],
            ['name' => 'Tailwind CSS', 'category' => 'frontend', 'order' => 5],
            ['name' => 'React', 'category' => 'frontend', 'order' => 6],

            // Tools & DevOps: Containerization and AWS first
            ['name' => 'AWS (ECS Fargate, ECR, RDS)', 'category' => 'tools', 'order' => 1],
            ['name' => 'Docker & Containerization', 'category' => 'tools', 'order' => 2],
            ['name' => 'GitHub Actions (CI/CD)', 'category' => 'tools', 'order' => 3],
            ['name' => 'TDD (Pest & PHPUnit)', 'category' => 'tools', 'order' => 4],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }

        // 1. Create the specific "DevPulse" project manually
        $devPulse = Project::create([
            'title' => 'DevPulse',
            'slug' => 'devpulse',
            'description' => 'A production-grade full-stack ecosystem leveraging a decoupled architecture and containerized cloud deployment.',
            'thumbnail_url' => 'https://devpulse-assets.s3.us-east-1.amazonaws.com/DevPulse.png', // Replace with a screenshot later!
            'tech_stack' => ['Laravel 12', 'PHP 8.4', 'Next.js 15', 'PostgreSQL', 'Docker', 'AWS ECS'],
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
            'live_url' => 'https://mbilal.ca'
        ]);

        // 2. Create the TaskFlow project manually
        $taskFlow = Project::create([
            'title' => 'TaskFlow',
            'slug' => 'taskflow',
            'description' => 'A containerized full-stack ecosystem demonstrating high-performance communication between a headless Laravel API and a Next.js SSR frontend.',
            'thumbnail_url' => 'https://devpulse-assets.s3.us-east-1.amazonaws.com/TaskFlowBright.png',
            'tech_stack' => ['Laravel 12', 'PHP 8.4', 'Next.js 15', 'PostgreSQL', 'Docker', 'AWS App Runner'],
            'is_featured' => true,
            'order' => 2,
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

        // 3. NEW: Keepr (AI Note Vault)
        $keepr = Project::create([
            'title' => 'Keepr',
            'slug' => 'keepr',
            'description' => 'A sophisticated AI-powered document vault implementing RAG (Retrieval-Augmented Generation) and vector embeddings to provide semantic search and intelligent insights for personal notes.',
            'thumbnail_url' => 'https://devpulse-assets.s3.us-east-1.amazonaws.com/keepr.png',
            'tech_stack' => ['Laravel 12', 'Next.js 15', 'Gemini AI', 'TanStack Query', 'Axios', 'AWS:ECS/Fargate'],
            'is_featured' => true,
            'order' => 3,
        ]);

        $keepr->detail()->create([
            'problem_statement' => 'Standard note-taking applications act as static repositories, requiring manual organization and lacking the ability to provide deep context or cross-document intelligence.',
            'solution_approach' => 'Architected a RAG pipeline using Google Gemini AI and vector embeddings to transform raw notes into a searchable knowledge base. The system utilizes a headless Laravel 12 backend for AI processing and TanStack Query on the frontend to manage complex server-state synchronization. Deployment leverages a high-availability AWS ECS sidecar architecture.',
            'repository_links' => [
                'frontend' => 'https://github.com/saqibbilal/vault-ui',
                'backend' => 'https://github.com/saqibbilal/vault-api'
            ],
            'feature_highlights' => [
                'RAG (Retrieval-Augmented Generation) for context-aware document insights and summaries.',
                'Semantic Search capabilities powered by vector embeddings for meaning-based retrieval.',
                'Multi-container sidecar pattern (Nginx + PHP-FPM) on AWS ECS Fargate.',
                'TanStack Query for robust client-side state management and background synchronization.',
                'Secure PostgreSQL schema with JSONB support for hybrid structured/unstructured data.',
                'AWS ALB with Host Header routing and SSL termination for secure cross-origin communication.'
            ],
            'live_url' => 'https://keepr-xi.vercel.app/'
        ]);
    }
}
