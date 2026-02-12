@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<h2>Checkout</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Shipping Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="shipping_address" class="form-label">Shipping Address</label>
                        <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                  id="shipping_address" 
                                  name="shipping_address" 
                                  rows="4" 
                                  required>{{ old('shipping_address', auth()->user()->address) }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Please provide your complete shipping address</div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Note:</strong> This is a demo application. No actual payment will be processed.
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cart.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Cart
                        </a>
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-check"></i> Place Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Order Summary</h5>
            </div>
            <div class="card-body">
                <h6>Items in Cart: {{ $cartItems->count() }}</h6>
                
                <div class="table-responsive mt-3">
                    <table class="table table-sm">
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>{{ $item->book->title }}</td>
                                    <td class="text-end">x{{ $item->quantity }}</td>
                                    <td class="text-end">${{ number_format($item->book->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-active">
                                <td colspan="2"><strong>Total:</strong></td>
                                <td class="text-end"><strong>${{ number_format($cart->getTotalPrice(), 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h6><i class="fas fa-shield-alt"></i> Secure Checkout</h6>
                <p class="small text-muted mb-0">Your information is protected and secure.</p>
            </div>
        </div>
    </div>
</div>
@endsection
