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

                    <h2>
                        Slug: {{ $project->title }}
                    </h2>

                    <p>
                        {{ $project->content }}
                    </p>

                    <p>
                        Type: 
                            @if ($project->type != null)
                                <a href="{{ route('admin.types.show', ['type' => $project->type->id]) }}" class="link-offset-2 link-underline link-underline-opacity-0">{{ $project->type->title }}</a>
                            @else
                                -
                            @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection