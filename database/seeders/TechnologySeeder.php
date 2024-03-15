<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Technology;

// Helpers
use Illuminate\Support\Facades\Schema;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Schema::disableForeignKeyConstraints();
        // Technology::truncate();
        // Schema::enableForeignKeyConstraints();

        $all_technologies = Technology::all();
        foreach ($all_technologies as $single_technology) {
            $single_technology->delete();
        }

        $all_technologies = [
            'HTML',
            'CSS',
            'JavaScript',
            'Vue',
            'PHP',
            'MySql',
            'Laravel'
        ];

        foreach ($all_technologies as $single_technology) {
            $single_technology = Technology::create([
                'title' => $single_technology,
                'slug' => Str()->slug($single_technology)
            ]);
        }
    }
}
