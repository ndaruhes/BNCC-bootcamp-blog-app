@extends('layouts.app')
@section('title', 'Explore Blog')

@section('content')
    <div class="container">
        @foreach ($blogs as $blog)
            <div class="col-md-4">
                <div class="col-md-12 rounded shadow-sm p-3">
                    <h3>{{ $blog->title }}</h3>
                    <p>{{ $blog->description }}</p>
                    <b>Author: <span>{{ $blog->user->name }}</span></b>
                </div>
            </div>
        @endforeach
    </div>
@endsection
