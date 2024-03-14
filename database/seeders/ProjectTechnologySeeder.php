<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Project;
use App\Models\Technology;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            $technologies = Technology::inRandomOrder()->limit(rand(0, 3))->get();
            foreach ($technologies as $technology) {
                $project->technologies()->attach($technology->id);
            }
        }
    }
}
