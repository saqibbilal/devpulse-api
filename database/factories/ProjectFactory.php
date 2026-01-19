<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
// database/factories/ProjectFactory.php

    public function definition(): array
    {
        $techPool = ['Next.js', 'Laravel', 'React', 'TypeScript', 'Docker', 'AWS', 'Tailwind', 'PostgreSQL'];

        return [
            'title' => fake()->words(3, true), // Generates a 3-word project name
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(),
            'thumbnail_url' => 'https://picsum.photos/seed/' . fake()->uuid . '/600/400', // Random placeholder image
            'tech_stack' => fake()->randomElements($techPool, rand(2, 5)), // Picks 2-5 random items
            'live_url' => fake()->url(),
            'github_url' => 'https://github.com/your-username/' . fake()->slug(),
            'order' => fake()->unique()->numberBetween(1, 100),
            'is_featured' => fake()->boolean(80), // 80% chance of being featured
        ];
    }
}
