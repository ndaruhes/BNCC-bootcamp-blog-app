@extends('layouts.app')
@section('title', 'Manage Category')

@section('content')
    <div class="container">
        <div class="col-md-6 p-3 shadow rounded">
            <h4>Manage Category</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <hr>

            {{-- CREATE FORM MODAL --}}
            @include('category.create')
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                Create Category
            </button>

            {{-- SUCCESS MESSAGE --}}
            @if (session('pesan_sukses'))
                <div class="alert alert-success">{{ session('pesan_sukses') }}</div>
            @endif

            {{-- CONTENT --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}</td>
                            <td>{{ $category->title }}</td>
                            <td>
                                <a href="{{ route('editCategory', $category->id) }}" class="btn btn-primary btn-sm">
                                    Edit
                                </a>
                                <a href="{{ route('deleteCategory', $category->id) }}" class="btn btn-danger btn-sm"
                                    onclick="event.preventDefault(); document.getElementById('delete-category-{{ $category->id }}').submit()">
                                    Delete
                                </a>

                                <form action="{{ route('deleteCategory', $category->id) }}"
                                    id="delete-category-{{ $category->id }}" class="d-none" method="POST">
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
