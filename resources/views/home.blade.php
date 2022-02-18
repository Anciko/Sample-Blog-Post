@extends('layout')

@section('title', 'Sample Blog Test')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{ route('posts.create') }}" class="btn btn-info btn-sm text-white shadow mb-2">Create + </a>
            </div>
            <div>
                <a href="" class="btn btn-sm btn-dark mb-2 shadow"> {{ auth()->user()->name }} </a>
                <a href="{{ route('user_logout') }}" class="btn btn-warning shadow btn-sm mb-2">Logout</a>
            </div>
        </div>
        @if (Session::has('success'))
            <div class="col-md-4 offset-md-4">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="row mt-3">
            @foreach ($posts as $post)
                <div class="col-md-4">
                    <div class="card border-0 shadow mb-2">
                        <div class="card-body">
                            <h4>{{ $post->name }}</h4>
                            <div class="card-text">
                                {{ $post->description }}
                            </div>
                            <div class="mt-2 ">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success btn-sm">Show</a>
                                <a href=" {{ route('posts.edit', $post->id) }} " class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
