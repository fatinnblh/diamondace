@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Manage Orders') }}</span>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">
                        {{ __('Back to Dashboard') }}
                    </a>
                </div>

                <div class="card-body">
                    @if($orders->isEmpty())
                        <div class="alert alert-info">
                            No orders found.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Paper Size</th>
                                        <th>Binding Style</th>
                                        <th>Cover Color</th>
                                        <th>Quantity</th>
                                        <th>Shipping</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                                            <td>{{ $order->paper_size }}</td>
                                            <td>{{ $order->binding_style }}</td>
                                            <td>{{ $order->cover_colour }}</td>
                                            <td>{{ $order->quantity }}</td>
                                            <td>{{ $order->shipping_option }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>
                                                <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'info') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('orders.summary', $order->id) }}" 
                                                       class="btn btn-outline-primary">
                                                        View
                                                    </a>
                                                    <!-- Add more action buttons as needed -->
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
