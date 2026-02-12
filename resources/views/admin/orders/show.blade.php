@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<h2>Order #{{ $order->id }} Details</h2>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header">
                <h5>Customer Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                <p><strong>Shipping Address:</strong><br>{{ $order->shipping_address }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Order Items</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Book</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->book->title }}</td>
                                    <td>{{ $item->book->author }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                <td><strong>${{ number_format($order->total_price, 2) }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Order Status</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Update Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5>Order Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Order Date:</strong><br>{{ $order->created_at->format('M d, Y H:i') }}</p>
                <p><strong>Last Updated:</strong><br>{{ $order->updated_at->format('M d, Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary w-100">Back to Orders</a>
        </div>
    </div>
</div>
@endsection
