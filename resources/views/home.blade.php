@extends('layouts.app')
@section('title')
    Home Page | Blog App
@endsection


@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <h3>Welcome to Blog App</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio distinctio illo itaque dolorum earum, facilis
                placeat sed molestiae numquam quisquam. Hic rerum corrupti accusantium at unde aperiam. Soluta, maxime!
                Obcaecati?</p>
            <hr>
            <a href="{{ url('blog/all') }}" class="btn btn-primary">Explore All Blog</a>
        </div>
    </div>
    {{-- @guest
        <h1>Okee</h1>
    @else
        @if (Auth::user()->role == 'Admin')
            <h1>Halo Admin</h1>
        @else
            <h1>Halo Member</h1>
        @endif
    @endguest --}}
@endsection
