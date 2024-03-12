<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

// Models
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

// Form Requests
use App\Http\Requests\StoreProjectRequest;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.create", compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->validated();

        $cover_img_path = null;
        if (isset($validated_data['cover_img'])) {
            $cover_img_path = Storage::disk('public')->put('images', $validated_data['cover_img']);
        }

        $project = new Project($validated_data);
        $project->title = $validated_data["title"];
        $project->slug = Str::slug($validated_data["title"]);
        $project->content = $validated_data["content"];
        $project->type_id = $validated_data["type_id"];
        $project->cover_img = $cover_img_path;

        $project->save();

        if (isset($validated_data['technologies'])) {
            foreach ($validated_data['technologies'] as $single_technology_id) {
                // attach this technology_id to this project
                $project->technologies()->attach($single_technology_id);
            }
        }
        ;

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $types = Type::all();
        $technologies = Technology::all();

        $project = Project::where("slug", $slug)->firstOrFail();
        return view("admin.projects.edit", compact("project", "types", "technologies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $slug)
    {
        $validated_data = $request->validated();
        $project = Project::where("slug", $slug)->firstOrFail();

        $cover_img_path = $project->cover_img;
        if (isset($validated_data['cover_img'])) {
            if ($project->cover_img != null) {
                Storage::disk('public')->delete($project->cover_img);
            }
            $cover_img_path = Storage::disk('public')->put('images', $validated_data['cover_img']);
        } else if (isset($validated_data['delete_cover_img'])) {
            Storage::disk('public')->delete($project->cover_img);
            $cover_img_path = null;
        }

        $project->title = $validated_data["title"];
        $project->slug = Str::slug($validated_data["title"]);
        $project->content = $validated_data["content"];
        $project->type_id = $validated_data["type_id"];
        $project->cover_img = $cover_img_path;

        $project->save();

        // 1. no changes
        // 2. add something
        // 3. remove something
        // 4. remove everything
        // 5. remove and add something

        if (isset($validated_data['technologies'])) {
            $project->technologies()->sync($validated_data['technologies']);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();

        if ($project->cover_img != null) {
            Storage::disk('public')->delete($project->cover_img);
        }

        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
