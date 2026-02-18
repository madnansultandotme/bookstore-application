@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-800">Shopping Cart</h2>
        <span class="text-sm text-gray-500">{{ $cartItems->count() }} Items</span>
    </div>

    @if($cartItems->isEmpty())
        <div class="p-10 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 mb-4">
                <i class="fas fa-shopping-cart text-2xl text-primary"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Your cart is empty</h3>
            <p class="text-gray-500 mb-6">Looks like you haven't added any books yet.</p>
            <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                Start Shopping
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-16 w-12 bg-gray-200 rounded overflow-hidden">
                                        @if($item->book->image)
                                            <img class="h-16 w-12 object-cover" src="{{ asset('storage/' . $item->book->image) }}" alt="{{ $item->book->title }}">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center text-gray-400">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->book->title }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->book->author }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rs {{ number_format($item->book->price, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->book->stock }}" 
                                           class="w-16 rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 text-sm">
                                    <button type="submit" class="text-primary hover:text-indigo-900 text-sm font-medium">Update</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Rs {{ number_format($item->book->price * $item->quantity, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('cart.remove', $item) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right text-sm font-medium text-gray-900">Total:</td>
                        <td class="px-6 py-4 whitespace-nowrap text-lg font-bold text-gray-900">Rs {{ number_format($total, 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-4">
            <a href="{{ route('books.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                Continue Shopping
            </a>
            <a href="{{ route('checkout') }}" class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                Proceed to Checkout
            </a>
        </div>
    @endif
</div>
@endsection
