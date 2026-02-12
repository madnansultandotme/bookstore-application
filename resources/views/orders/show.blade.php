@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>Order #{{ $order->id }}</h2>
        
        <div class="card mb-3">
            <div class="card-header">
                <h5>Order Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Status:</strong> 
                            @php
                                $statusColors = [
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'shipped' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger'
                                ];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Total Amount:</strong> <span class="text-success">${{ number_format($order->total_price, 2) }}</span></p>
                    </div>
                </div>
                <div class="mt-3">
                    <p><strong>Shipping Address:</strong></p>
                    <p>{{ $order->shipping_address }}</p>
                </div>
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

        <div class="mt-3">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Order Status</h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="mb-3">
                        <i class="fas fa-check-circle text-success"></i>
                        <strong>Order Placed</strong>
                        <p class="text-muted small">{{ $order->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    
                    @if(in_array($order->status, ['processing', 'shipped', 'delivered']))
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Processing</strong>
                        </div>
                    @endif
                    
                    @if(in_array($order->status, ['shipped', 'delivered']))
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Shipped</strong>
                        </div>
                    @endif
                    
                    @if($order->status === 'delivered')
                        <div class="mb-3">
                            <i class="fas fa-check-circle text-success"></i>
                            <strong>Delivered</strong>
                        </div>
                    @endif
                    
                    @if($order->status === 'cancelled')
                        <div class="mb-3">
                            <i class="fas fa-times-circle text-danger"></i>
                            <strong>Cancelled</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
