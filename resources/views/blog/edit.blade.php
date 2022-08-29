@extends('layouts.app')
@section('title', 'Edit Blog')


@section('content')
    <div class="container">
        <div class="col-md-8 p-3 shadow rounded">
            <h4>Edit Blog</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <hr>

            {{-- CONTENT --}}
            <form action="{{ route('updateBlog', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">Cover</label>
                    <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover"
                        value="{{ old('cover') }}">
                    @error('cover')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Masukkan judul kategori" name="title"
                        value="{{ old('title') != null ? old('title') : $blog->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Blog Category</label>
                    <select name="category" class="form-control @error('category') is-invalid @enderror">
                        <option selected>Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Description</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Masukkan deskripsi" name="description"
                        value="{{ old('description') != null ? old('description') : $blog->description }}">
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="">Content</label>
                    <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror"
                        placeholder="Masukkan konten">{{ old('content') != null ? old('content') : $blog->content }}</textarea>
                    @error('content')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
        </div>
    </div>
@endsection
