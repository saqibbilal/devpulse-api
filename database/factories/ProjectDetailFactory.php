<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectDetail>
 */
class ProjectDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // RULE: We don't define project_id here; we handle it in the Seeder or using Factory Relationships
            'problem_statement' => fake()->paragraph(),
            'solution_approach' => fake()->paragraphs(2, true),
            'repository_links' => [
                'frontend' => 'https://github.com/devpulse/' . fake()->slug(),
                'backend' => 'https://github.com/devpulse/' . fake()->slug() . '-api',
            ],
            'feature_highlights' => fake()->randomElements([
                'Real-time Notifications', 'JWT Authentication', 'S3 File Uploads',
                'Stripe Integration', 'Responsive Design', 'Unit Testing'
            ], 3),
            'live_url' => fake()->url(),
        ];
    }
}
