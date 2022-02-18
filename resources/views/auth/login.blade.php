@extends('layout')

@section('title', 'Login')

@section('content')
    <div class="container mt-3">
        <div class="col-md-6 offset-md-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('success'))
                <p class="text-success"> {{ Session::get('success') }}</p>
            @endif
            <div class="card p-5 bg-light">
                <form action=" {{ route('user_login') }} " method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>
                    <div class="mb-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="align-self-center">
                            <a href="{{ route('register') }}">Not a memeber?</a>
                        </div>
                        <div class="">
                            <button type="reset" class="btn btn-outline-secondary ">Cancel</button>
                            <button type="submit" class="btn btn-info text-white">Login</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
