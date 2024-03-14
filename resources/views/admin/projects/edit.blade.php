@extends('layouts.app')

@section('page-title', $project->title . ' EDIT')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{$project->title}} EDIT
                    </h1>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.projects.update', ['project' => $project->slug]) }}" method="POST" enctype="multipart/form-data">
                        
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Insert title..." value="{{ old('title', $project->title) }}">
                            @error('title')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_id" class="form-label">Type</label>
                            <select name="type_id" id="type_id" class="form-select">
                                <option value="" {{ old('type_id', $project->type_id) == null ? 'selected' : '' }}>Select a type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id', $project->type_id) == $type->id ? 'selected' : '' }}>{{ $type->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="technology" class="form-label">Technology</label>
                            <div> 
                                @foreach ($technologies as $technology)
                                    <div class="form-check form-check-inline">
                                        <input  @if ($errors->any())
                                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                                                {{-- differently from in_array, we now check if an element ($technology->id) is present in a COLLECTION ($project->technologies) --}}
                                                @else
                                                    {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}
                                                @endif
                                                class="form-check-input"
                                                type="checkbox"
                                                id="tag-{{ $technology->id }}"
                                                name="technologies[]"
                                                value="{{ $technology->id }}">
                                        <label class="form-check-label" for="tag-{{ $technology->id }}">{{ $technology->title }}</label>
                                    </div> 
                                @endforeach
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cover_img" class="form-label">Cover image</label>
                            <input class="form-control" type="file" id="cover_img" name="cover_img">

                            @if ($project->cover_img != null)
                                <div class="mt-3 mb-3">
                                    <h4>
                                        Actual cover:
                                    </h4>
                                    <img src="{{ $project->full_cover_img }}">
                                    <div class="form-check mt-1 mb-1">
                                        <input class="form-check-input" type="checkbox" value="1" id="delete_cover_img" name="delete_cover_img">
                                        <label class="form-check-label" for="delete_cover_img">
                                            Delete img
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <input type="text" class="form-control @error('content') is-invalid @enderror" id="content" name="content" placeholder="Insert content" value="{{ old('content', $project->content) }}">
                            @error('content')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="btn btn-warning w-100">
                                EDIT
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection