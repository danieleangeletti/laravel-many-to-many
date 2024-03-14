@extends('layouts.app')

@section('page-title', $project->title)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{$project->title}}
                    </h1>

                    <p>
                        {{ $project->content }}
                    </p>
                    
                    @if ($project->cover_img != null)
                        <div class="mb-3">
                            <img src="{{ $project->full_cover_img }}">
                        </div>
                    @endif

                    <p>
                        Type: 
                            @if ($project->type != null)
                                <a href="{{ route('admin.types.show', ['type' => $project->type->id]) }}" class="link-offset-2 link-underline link-underline-opacity-0">{{ $project->type->title }}</a>
                            @else
                                -
                            @endif
                    </p>
                    <p>
                        Technologies: 
                            @forelse ($project->technologies as $technology)
                                <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="link-offset-2 link-underline link-underline-opacity-0">{{ $technology->title }}</a>
                            @empty
                                -
                            @endforelse
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection