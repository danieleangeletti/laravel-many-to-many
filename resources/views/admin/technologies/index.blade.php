@extends('layouts.app')

@section('page-title', 'All technologies')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        All technologies
                    </h1>

                    <a href="{{ route('admin.technologies.create') }}" class="btn btn-primary w-100">ADD TECHNOLOGY</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($technologies as $technology)
                                <tr>
                                    <th scope="row">{{ $technology->id }}</th>
                                    <td>{{ $technology->title }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="ms-1 me-1">
                                                <a href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}" class="btn btn-primary">SHOW</a>
                                            </div>
                                            <div class="ms-1 me-1">
                                                <a href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}" class="btn btn-warning">EDIT</a>
                                            </div>
                                            <div class="ms-1 me-1">
                                                <form onsubmit="return confirm('Are you sure you want to delete this technology?')" action="{{route ('admin.technologies.destroy', ['technology' => $technology->id])}}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        DELETE
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
