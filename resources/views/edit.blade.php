@extends('layout')

@section('title', 'Edit Post')

@section('content')
     <div class="container ">
        <div class="col-md-4 offset-md-4">
            <a href="{{ URL::previous() }}"> Back </a>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-danger"> {{ $error }} </p>
                @endforeach
            @endif
            <div class="card p-4">
                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="mb-1">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $post->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="mb-1">Description</label>
                        <textarea name="description" id="desc" cols="30" rows="10" class="form-control">
                            {{ old('description', $post->description) }}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $cat->id == $post->category_id ? "selected" : "" }}  > {{ $cat->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline-warning me-2">Cancel</button>
                        <button type="submit" class="btn btn-info text-white">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
