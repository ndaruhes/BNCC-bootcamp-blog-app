<div class="modal fade" id="createBlogModal" tabindex="-1" aria-labelledby="createBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBlogModalLabel">Create Blog</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeBlog') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="">Cover</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover">
                        @error('cover')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            placeholder="Masukkan judul kategori" name="title" value="{{ old('title') }}">
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
                            placeholder="Masukkan deskripsi" name="description" value="{{ old('description') }}">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Content</label>
                        <textarea name="content" rows="5" class="form-control @error('content') is-invalid @enderror"
                            placeholder="Masukkan konten">{{ old('content') }}</textarea>
                        @error('content')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
