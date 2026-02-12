@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="row">
    <div class="col-md-8">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('books.index') }}">Books</a></li>
                <li class="breadcrumb-item active">{{ $book->title }}</li>
            </ol>
        </nav>

        <div class="card">
            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->title }}">
            @else
                <div class="card-img-top bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="fas fa-book fa-5x"></i>
                </div>
            @endif
            
            <div class="card-body">
                <h1 class="card-title">{{ $book->title }}</h1>
                <h5 class="text-muted mb-3">by {{ $book->author }}</h5>
                
                <div class="mb-3">
                    <span class="badge bg-primary">{{ $book->category->name }}</span>
                    @if($book->isbn)
                        <span class="badge bg-secondary">ISBN: {{ $book->isbn }}</span>
                    @endif
                </div>

                <h3 class="text-success mb-3">${{ number_format($book->price, 2) }}</h3>

                <div class="mb-3">
                    @if($book->isInStock())
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle"></i> In Stock ({{ $book->stock }} available)
                        </span>
                    @else
                        <span class="badge bg-danger">
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </span>
                    @endif
                </div>

                @if($book->description)
                    <h5 class="mt-4">Description</h5>
                    <p class="card-text">{{ $book->description }}</p>
                @endif

                <div class="mt-4">
                    @auth
                        @if($book->isInStock())
                            <form action="{{ route('cart.add', $book) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="fas fa-ban"></i> Out of Stock
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Login to Purchase
                        </a>
                    @endauth
                    
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left"></i> Back to Books
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Book Details</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th>Author:</th>
                        <td>{{ $book->author }}</td>
                    </tr>
                    <tr>
                        <th>Category:</th>
                        <td>{{ $book->category->name }}</td>
                    </tr>
                    <tr>
                        <th>Price:</th>
                        <td class="text-success">${{ number_format($book->price, 2) }}</td>
                    </tr>
                    @if($book->isbn)
                    <tr>
                        <th>ISBN:</th>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th>Availability:</th>
                        <td>
                            @if($book->isInStock())
                                <span class="text-success">In Stock</span>
                            @else
                                <span class="text-danger">Out of Stock</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">More from {{ $book->category->name }}</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">
                    <a href="{{ route('books.index', ['category' => $book->category_id]) }}">
                        Browse more {{ $book->category->name }} books
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
