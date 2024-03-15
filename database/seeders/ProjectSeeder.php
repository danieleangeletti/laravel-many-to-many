<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


// Models
use App\Models\Project;
use App\Models\Type;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Project::truncate();
        Schema::enableForeignKeyConstraints();

        // Deletion of previous cover_img files
        $old_cover_images = Storage::disk('public')->files('images');
        foreach ($old_cover_images as $old_cover_image) {
            Storage::disk('public')->delete($old_cover_image);
        }

        // Deletion of previous cover_img files (2nd method)
        // Storage::disk('public')->deleteDirectory('images');
        // Storage::disk('public')->makeDirectory('images');

        for ($i = 0; $i < 10; $i++) {
            $cover_img_path = fake()->image(storage_path('/app/public/images'), 400, 400, null, false);
            $title = fake()->sentence();
            $slug = Str::slug($title);
            $project = Project::create([
                'title' => $title,
                'slug' => $slug,
                'content' => fake()->paragraph(),
                'type_id' => Type::inRandomOrder()->first()->id,
                'cover_img' => 'images/' . $cover_img_path
            ]);
        }
    }
}
