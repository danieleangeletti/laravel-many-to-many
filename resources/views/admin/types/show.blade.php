@extends('layouts.app')

@section('page-title', $type->title)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{$type->title}}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center text-success">
                        All projects associated with this type
                    </h2>
                    <ul>
                        @foreach ($type->projects as $project)
                            <li>
                                <a href="{{ route('admin.projects.show', ['project' => $project->slug]) }}" class="link-offset-2 link-underline link-underline-opacity-0">
                                    {{ $project->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection