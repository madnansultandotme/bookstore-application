@extends('layouts.app')

@section('title', 'Browse Books')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h5>Filters</h5>
        <form action="{{ route('books.index') }}" method="GET">
            <div class="mb-3">
                <label class="form-label">Search</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Title or Author">
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Price Range</label>
                <div class="row">
                    <div class="col">
                        <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}" step="0.01">
                    </div>
                    <div class="col">
                        <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}" step="0.01">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary w-100 mt-2">Clear</a>
        </form>
    </div>

    <div class="col-md-9">
        <h2>Books</h2>
        <div class="row">
            @forelse($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">by {{ $book->author }}</p>
                            <p class="card-text">{{ Str::limit($book->description, 100) }}</p>
                            <p class="card-text"><strong>${{ number_format($book->price, 2) }}</strong></p>
                            <p class="card-text">
                                <small class="text-muted">Category: {{ $book->category->name }}</small>
                            </p>
                            <p class="card-text">
                                <small class="{{ $book->isInStock() ? 'text-success' : 'text-danger' }}">
                                    {{ $book->isInStock() ? 'In Stock' : 'Out of Stock' }}
                                </small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">View Details</a>
                            @auth
                                @if($book->isInStock())
                                    <form action="{{ route('cart.add', $book) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No books found.</p>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
