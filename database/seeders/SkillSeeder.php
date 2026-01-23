<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'PHP', 'category' => 'backend'],
            ['name' => 'Laravel', 'category' => 'backend'],
            ['name' => 'PostgreSQL', 'category' => 'backend'],
            ['name' => 'Docker', 'category' => 'backend'],
            ['name' => 'AWS', 'category' => 'backend'],
            ['name' => 'React', 'category' => 'frontend'],
            ['name' => 'Next.js', 'category' => 'frontend'],
            ['name' => 'TypeScript', 'category' => 'frontend'],
            ['name' => 'Tailwind CSS', 'category' => 'frontend'],
        ];

        foreach ($skills as $skill) {
            \App\Models\Skill::create($skill);
        }
    }
}
