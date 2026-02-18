@extends('layouts.app')

@section('title', 'Welcome to BookStore')

@section('content')
<!-- Hero Section -->
<div class="bg-primary rounded-lg shadow-lg overflow-hidden mb-12">
    <div class="px-6 py-16 sm:px-12 sm:py-24 lg:flex lg:items-center lg:justify-between">
        <div class="lg:w-0 lg:flex-1">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                <span class="block">Welcome to</span>
                <span class="block">Pakistan's BookStore</span>
            </h1>
            <p class="mt-5 text-xl text-white opacity-90 max-w-3xl">
                Discover thousands of books at amazing prices. From bestsellers to hidden gems, find your next great read today!
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('books.index') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-100 shadow-lg transition">
                    Browse Books
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3 border-2 border-white text-base font-medium rounded-md text-white hover:bg-white hover:text-primary transition">
                    Contact Us
                </a>
            </div>
        </div>
        <div class="mt-12 lg:mt-0 lg:ml-8">
            <div class="flex items-center justify-center">
                <i class="fas fa-book-open text-white text-9xl opacity-20"></i>
            </div>
        </div>
    </div>
</div>

<!-- Featured Books -->
<div class="mb-16">
    <div class="flex items-center justify-between mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Featured Books</h2>
        <a href="{{ route('books.index') }}" class="text-primary hover:text-indigo-700 font-medium transition">
            View All <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($featuredBooks as $book)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col h-full group">
                <div class="relative h-64 bg-gray-100 overflow-hidden">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $book->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 group-hover:bg-gray-200 transition">
                            <i class="fas fa-book fa-3x"></i>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                            In Stock
                        </span>
                    </div>
                </div>
                
                <div class="p-5 flex-grow flex flex-col">
                    <div class="mb-2">
                        <span class="text-xs uppercase tracking-wider text-primary font-bold bg-indigo-50 px-2 py-1 rounded">{{ $book->category->name }}</span>
                    </div>
                    <h5 class="text-lg font-bold text-gray-900 mb-1 leading-tight group-hover:text-primary transition">{{ $book->title }}</h5>
                    <p class="text-sm text-gray-600 mb-3">by <span class="font-medium">{{ $book->author }}</span></p>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-3 flex-grow">{{ $book->description }}</p>
                    
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xl font-bold text-gray-900">Rs {{ number_format($book->price, 2) }}</span>
                        <div class="flex gap-2">
                            <a href="{{ route('books.show', $book) }}" class="p-2 text-gray-400 hover:text-primary transition" title="View Details">
                                <i class="fas fa-eye text-lg"></i>
                            </a>
                            @auth
                                <form action="{{ route('cart.add', $book) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-secondary transition" title="Add to Cart">
                                        <i class="fas fa-cart-plus text-lg"></i>
                                    </button>
                                </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-gray-500">
                <i class="fas fa-book fa-3x mb-4 text-gray-300"></i>
                <p class="text-lg font-medium">No books available at the moment.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- Categories Section -->
<div class="bg-gray-50 rounded-lg p-8 mb-16 border border-gray-200">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Browse by Category</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('books.index', ['category' => $category->id]) }}" class="bg-white rounded-lg p-6 text-center hover:shadow-lg transition-all duration-300 border border-gray-200 hover:border-primary group">
                <i class="fas fa-book text-3xl text-primary mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-bold text-gray-900 group-hover:text-primary transition">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $category->books_count }} books</p>
            </a>
        @endforeach
    </div>
</div>

<!-- Why Choose Us -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
    <div class="text-center p-6 bg-white rounded-lg border border-gray-200">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-lg mb-4">
            <i class="fas fa-shipping-fast text-2xl text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Fast Delivery</h3>
        <p class="text-gray-600">Quick delivery across Pakistan</p>
    </div>
    <div class="text-center p-6 bg-white rounded-lg border border-gray-200">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-lg mb-4">
            <i class="fas fa-shield-alt text-2xl text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">Secure Payment</h3>
        <p class="text-gray-600">Safe and secure transactions</p>
    </div>
    <div class="text-center p-6 bg-white rounded-lg border border-gray-200">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-lg mb-4">
            <i class="fas fa-headset text-2xl text-white"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">24/7 Support</h3>
        <p class="text-gray-600">Always here to help you</p>
    </div>
</div>
@endsection
