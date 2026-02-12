@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<h2>Edit Book</h2>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $book->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" 
                           id="author" name="author" value="{{ old('author', $book->author) }}" required>
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="4">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           id="price" name="price" value="{{ old('price', $book->price) }}" step="0.01" required>
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                           id="stock" name="stock" value="{{ old('stock', $book->stock) }}" required>
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" 
                            id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                           id="isbn" name="isbn" value="{{ old('isbn', $book->isbn) }}">
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($book->image)
                        <div class="form-text">Current image: {{ basename($book->image) }}</div>
                    @endif
                </div>
            </div>

            <div class="text-end">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Book</button>
            </div>
        </form>
    </div>
</div>
@endsection
