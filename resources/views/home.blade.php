@extends('layouts.app')
@section('title')
    Home Page | Blog App
@endsection


@section('content')
    @guest
        <h1>Okee</h1>
    @else
        @if (Auth::user()->role == 'Admin')
            <h1>Halo Admin</h1>
        @else
            <h1>Halo Member</h1>
        @endif
    @endguest
@endsection
