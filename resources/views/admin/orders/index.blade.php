@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Manage Orders') }}</span>
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
                                        <th>Payment Method</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>ID{{ $order->id }}</td>
                                            <td>{{ $order->formatted_payment_method }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.orders.show', $order->id) }}" 
                                                       class="btn btn-sm btn-link p-0 me-2">
                                                        <img src="{{ asset('images/edit.png') }}" alt="Edit" style="width: 24px; height: 24px;">
                                                    </a>
                                                    @if($order->status === 'payment_verified')
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-success"
                                                            onclick="updateStatus({{ $order->id }}, 'printing_in_progress')">
                                                        Start Printing
                                                    </button>
                                                    @elseif($order->status === 'printing_in_progress')
                                                    <button type="button" 
                                                            class="btn btn-sm btn-outline-success"
                                                            onclick="updateStatus({{ $order->id }}, 'ready')">
                                                        Mark as Ready
                                                    </button>
                                                    @endif
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

<script>
function updateStatus(orderId, newStatus) {
    if (confirm('Are you sure you want to update this order\'s status?')) {
        fetch(`/admin/orders/${orderId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        });
    }
}
</script>
@endsection
