@extends('layouts.app')

@section('title', 'Browse Books')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    <!-- Filters Sidebar -->
    <div class="w-full md:w-1/4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-24">
            <h5 class="font-bold text-lg mb-4 text-gray-900 flex items-center gap-2">
                <i class="fas fa-filter text-primary"></i> Filters
            </h5>
            <form action="{{ route('books.index') }}" method="GET">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" value="{{ request('search') }}" placeholder="Title or Author">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Price Range</label>
                    <div class="flex gap-2">
                        <input type="number" name="min_price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" placeholder="Min" value="{{ request('min_price') }}" step="0.01">
                        <input type="number" name="max_price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-2 border" placeholder="Max" value="{{ request('max_price') }}" step="0.01">
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition duration-200 font-medium">Apply Filters</button>
                <a href="{{ route('books.index') }}" class="block text-center w-full mt-3 text-sm text-gray-600 hover:text-gray-900 transition">Clear Filters</a>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="w-full md:w-3/4">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">Books Collection</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($books as $book)
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
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $book->isInStock() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $book->isInStock() ? 'In Stock' : 'Out of Stock' }}
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
                                    @if($book->isInStock())
                                        <form action="{{ route('cart.add', $book) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="p-2 text-gray-400 hover:text-secondary transition" title="Add to Cart">
                                                <i class="fas fa-cart-plus text-lg"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center text-gray-500 bg-white rounded-lg border border-dashed border-gray-300">
                    <i class="fas fa-search fa-3x mb-4 text-gray-300"></i>
                    <p class="text-lg font-medium">No books found matching your criteria.</p>
                    <a href="{{ route('books.index') }}" class="text-primary hover:underline mt-2 inline-block">Clear filters</a>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
