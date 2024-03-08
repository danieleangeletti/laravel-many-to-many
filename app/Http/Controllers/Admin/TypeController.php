<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Models
use App\Models\Type;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type_data = $request->validate([
            'title' => 'required|string|max:32'
        ]);

        $slug = Str()->slug($type_data['title']);
        $type = Type::create([
            'title' => $type_data['title'],
            'slug' => $slug
        ]);

        return redirect()->route('admin.types.show', compact('type'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Type $type)
    {
        $type_data = $request->validate([
            'title' => 'required|string|max:32'
        ]);

        $slug = Str()->slug($type_data['title']);
        $type->update([
            'title' => $type_data['title'],
            'slug' => $slug
        ]);

        return redirect()->route('admin.types.show', compact('type'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('admin.types.index');
    }
}
