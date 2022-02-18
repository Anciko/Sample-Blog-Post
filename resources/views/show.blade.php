@extends('layout')

@section('title', 'Post Detail')

@section('content')
    <div class="container">
        <div class="col-md-6 offset-md-2">
            <a href="{{ route('posts.index') }}" class="btn btn-dark btn-sm"> << Back </a>

            <div class="card mt-2">
                <div class="card-header text-info">
                    {{$post->name}}
                </div>
                <div class="card-body">
                    <p>{{ $post->description }}</p>
                    <p class="text-success"> Category : {{ $post->category->name }} </p>
                    <small class="text-muted"> {{ $post->updated_at }} </small>
                </div>
            </div>
        </div>
    </div>
@endsection
