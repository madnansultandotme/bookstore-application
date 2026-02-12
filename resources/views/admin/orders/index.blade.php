@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<h2>Manage Orders</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>${{ number_format($order->total_price, 2) }}</td>
                    <td>
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
                    </td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {{ $orders->links() }}
</div>
@endsection
