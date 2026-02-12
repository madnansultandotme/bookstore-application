@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<h2>Shopping Cart</h2>

@if($cartItems->isEmpty())
    <div class="alert alert-info">
        Your cart is empty. <a href="{{ route('books.index') }}">Browse books</a>
    </div>
@else
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{ $item->book->title }}</td>
                        <td>{{ $item->book->author }}</td>
                        <td>${{ number_format($item->book->price, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                       min="1" max="{{ $item->book->stock }}" class="form-control" style="width: 80px;">
                                <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($item->book->price * $item->quantity, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end"><strong>Total:</strong></td>
                    <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-end">
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Continue Shopping</a>
        <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
    </div>
@endif
@endsection
