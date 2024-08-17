<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            "listening",
            "writing",
            "speaking",
            "reading",
        ];

        foreach ($skills as $skill) {
            Skill::create([
                "skill_name" => $skill
            ]);
        };
    }
}
