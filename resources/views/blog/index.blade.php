@extends('layouts.app')
@section('title', 'Manage Blog')


@section('content')
    <div class="container">
        <div class="col-md-8 p-3 shadow rounded">
            <h4>Manage Blog</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <hr>

            {{-- CREATE FORM MODAL --}}
            @if (Auth::user()->role == 'Member')
                @include('blog.create')
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createBlogModal">
                    Create Blog
                </button>
            @endif

            {{-- SUCCESS MESSAGE --}}
            @if (session('pesan_sukses'))
                <div class="alert alert-success">{{ session('pesan_sukses') }}</div>
            @endif

            {{-- CONTENT --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}</td>
                            <td style="width: 20%">
                                <img src="{{ asset('storage/images/cover/' . $blog->cover) }}" alt="{{ $blog->title }}"
                                    class="w-100 rounded">
                            </td>
                            <td>
                                <span class="d-block">{{ $blog->title }}</span>
                                <span class="badge bg-info">{{ $blog->categoryeeeeee->title }}</span>
                            </td>
                            <td>{{ $blog->status }}</td>
                            <td>{{ $blog->description }}</td>
                            <td>{{ $blog->user->name }}</td>
                            <td>
                                @if (Auth::user()->role == 'Member')
                                    <a href="{{ route('editBlog', $blog->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                @else
                                    <a href="{{ route('editBlog', $blog->id) }}" class="btn btn-info btn-sm">
                                        Accept
                                    </a>
                                @endif
                                <a href="{{ route('deleteBlog', $blog->id) }}" class="btn btn-danger btn-sm"
                                    onclick="event.preventDefault(); document.getElementById('delete-category-{{ $blog->id }}').submit()">
                                    Delete
                                </a>

                                <form action="{{ route('deleteBlog', $blog->id) }}"
                                    id="delete-category-{{ $blog->id }}" class="d-none" method="POST">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
