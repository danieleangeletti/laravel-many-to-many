@extends('layouts.guest')

@section('page-title', 'All projects')

@section('main-content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-success">
                All projects
            </h1>
        </div>
        @foreach ($projects as $project)
            <div class="col-12 col-xs-6 col-sm-4 col-md-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            {{ $project->title }}
                        </h5>

                        <a href="{{ route('projects.show', ['project' => $project->slug]) }}" class="btn btn-primary">SHOW ALL</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
