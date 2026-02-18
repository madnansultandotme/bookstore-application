@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="py-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Shipping Details -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h5 class="text-lg font-medium text-gray-900">Shipping Information</h5>
                </div>
                <div class="p-6">
                    <form action="{{ route('orders.store') }}" method="POST" id="checkout-form">
                        @csrf
                        
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Payment Method</label>
                            <div class="space-y-3">
                                <div class="flex items-center p-4 border-2 border-primary bg-primary bg-opacity-5 rounded-lg">
                                    <input id="cod" name="payment_method" type="radio" value="cash_on_delivery" checked
                                        class="h-4 w-4 text-primary focus:ring-primary border-gray-300">
                                    <label for="cod" class="ml-3 flex-1 cursor-pointer">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="block text-sm font-medium text-gray-900">Cash on Delivery</span>
                                                <span class="block text-sm text-gray-500">Pay when you receive your order</span>
                                            </div>
                                            <i class="fas fa-money-bill-wave text-2xl text-primary"></i>
                                        </div>
                                    </label>
                                </div>
                                
                                <div class="flex items-center p-4 border-2 border-gray-200 rounded-lg opacity-50 cursor-not-allowed">
                                    <input id="online" name="payment_method" type="radio" value="online_payment" disabled
                                        class="h-4 w-4 text-gray-400 border-gray-300">
                                    <label for="online" class="ml-3 flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <span class="block text-sm font-medium text-gray-500">Online Payment</span>
                                                <span class="block text-sm text-gray-400">Coming Soon</span>
                                            </div>
                                            <i class="fas fa-credit-card text-2xl text-gray-400"></i>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                            <textarea id="shipping_address" name="shipping_address" rows="4" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                            @error('shipping_address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-gray-500">Please provide your complete shipping address including zip code.</p>
                        </div>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="{{ route('cart.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition">
                                <i class="fas fa-arrow-left mr-1"></i> Back to Cart
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition shadow-lg">
                                <i class="fas fa-check mr-2"></i> Place Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="md:col-span-1 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-24">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h5 class="text-lg font-medium text-gray-900">Order Summary</h5>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-500 mb-4">Items in Cart: <span class="font-medium text-gray-900">{{ $cartItems->count() }}</span></p>
                    
                    <div class="flow-root mb-6">
                        <ul class="divide-y divide-gray-200 -my-4">
                            @foreach($cartItems as $item)
                                <li class="py-4 flex text-sm">
                                    <div class="flex-grow">
                                        <p class="font-medium text-gray-900">{{ $item->book->title }}</p>
                                        <p class="text-gray-500">x{{ $item->quantity }}</p>
                                    </div>
                                    <div class="text-right font-medium text-gray-900">
                                        Rs {{ number_format($item->book->price * $item->quantity, 2) }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex justify-between text-base font-bold text-gray-900">
                            <p>Total</p>
                            <p>Rs {{ number_format($cart->getTotalPrice(), 2) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-shield-alt text-green-500 mr-2 text-lg"></i>
                        <span>Secure Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
