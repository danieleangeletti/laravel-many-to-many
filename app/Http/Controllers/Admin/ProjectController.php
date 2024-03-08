<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;

// Models
use App\Models\Project;
use App\Models\Type;

// Form Requests
use App\Http\Requests\StoreProjectRequest;

// Helpers
use Illuminate\Support\Str;

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
        $types = Type::All();
        return view("admin.projects.create", compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $validated_data = $request->validated();

        $project = new Project($validated_data);
        $project->title = $validated_data["title"];
        $project->slug = Str::slug($validated_data["title"]);
        $project->content = $validated_data["content"];
        $project->type_id = $validated_data["type_id"];

        $project->save();

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
        $types = Type::All();

        $project = Project::where("slug", $slug)->firstOrFail();
        return view("admin.projects.edit", compact("project", "types"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $slug)
    {
        $validated_data = $request->validated();
        $project = Project::where("slug", $slug)->firstOrFail();

        $project->title = $validated_data["title"];
        $project->slug = Str::slug($validated_data["title"]);
        $project->content = $validated_data["content"];
        $project->type_id = $validated_data["type_id"];

        $project->save();

        return redirect()->route('admin.projects.show', ['project' => $project->slug]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
