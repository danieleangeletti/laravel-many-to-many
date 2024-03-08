<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Models
use App\Models\Type;

// Helpers
use Illuminate\Support\Facades\Schema;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Type::truncate();
        Schema::enableForeignKeyConstraints();

        $all_types = [
            'Software/Application Development',
            'Web Development Projects',
            'Game Development',
            'Database Projects',
            'Cybersecurity Projects',
            'Automation and Scripting',
            'Project Management and Development Tools'
        ];

        foreach ($all_types as $single_type) {
            $single_type = Type::create([
                'title' => $single_type,
                'slug' => Str()->slug($single_type)
            ]);
        }
    }
}
