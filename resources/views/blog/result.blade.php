@extends('layouts.app')
@section('title', 'Search Result')

@section('content')
    <div class="container">
        @if ($blogs->count() == 0)
            <div class="alert alert-warning">Blog tidak ditemukan</div>
        @else
            <h3>Hasil Pencarian</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae voluptates cupiditate veniam molestiae</p>
            <hr>

            <form action="{{ route('searchBlog') }}" class="col-md-6 mb-4" method="POST">
                @csrf
                <input type="text" class="form-control" placeholder="Cari blog disini" name="searchInput">
            </form>

            <div class="row">
                @foreach ($blogs as $blog)
                    <div class="col-md-3">
                        <div class="col-md-12 rounded shadow-sm">
                            <img src="{{ '/storage/images/cover/' . $blog->cover }}" alt="{{ $blog->title }}"
                                class="w-100 rounded-top">
                            <div class="p-3">
                                <span class="badge bg-info">{{ $blog->categoryeeeeee->title }}</span>
                                <h4>{{ $blog->title }}</h4>
                                <p>{{ $blog->description }}</p>
                                <b>Author: <span>{{ $blog->user->name }}</span></b>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
