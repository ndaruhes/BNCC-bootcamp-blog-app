@extends('layouts.app')
@section('title', 'Edit Category')

@section('content')
    <div class="container">
        <div class="col-md-6 p-3 shadow rounded">
            <h4>Edit Category</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <hr>

            {{-- CONTENT --}}
            <form action="{{ route('updateCategory', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="">Category Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Masukkan judul kategori" name="title"
                        value="{{ old('title') != 0 ? old('title') : $category->title }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
            </table>
        </div>
    </div>
@endsection
