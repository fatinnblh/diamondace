@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Order ID{{ $order->id }} Status</h2>
                </div>
                <div class="card-body">
                    <div class="tracking-progress">
                        @foreach($order->status_steps as $step)
                            <div class="tracking-step {{ $step['active'] ? 'active' : '' }} {{ $step['current'] ? 'current' : '' }}">
                                <div class="tracking-icon">
                                    @if($step['active'])
                                        @if($loop->first)
                                            <img src="{{ asset('images/orderSubmit.png') }}" alt="Order Submitted" class="status-icon">
                                        @elseif($loop->iteration == 2)
                                            <img src="{{ asset('images/waitverify.png') }}" alt="Awaiting Payment" class="status-icon">
                                        @elseif($loop->iteration == 3)
                                            <img src="{{ asset('images/receipt.png') }}" alt="Payment Verified with Receipt" class="status-icon">
                                        @elseif($loop->iteration == 4)
                                            <img src="{{ asset('images/print.png') }}" alt="Printing in Progress" class="status-icon">
                                        @else
                                            <img src="{{ asset('images/ready.png') }}" alt="Ready to Pickup / Delivery" class="status-icon">
                                        @endif
                                    @else
                                        <div class="inactive-icon"></div>
                                    @endif
                                </div>
                                <div class="tracking-label">{{ $step['title'] }}</div>
                            </div>
                            @if(!$loop->last)
                                <div class="tracking-line {{ $step['active'] && $loop->iteration <= array_search(true, array_column($order->status_steps, 'current')) ? 'active' : '' }}"></div>
                            @endif
                        @endforeach
                    </div>

                    <div class="order-details mt-5">
                        <h3>Order Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Paper Size:</strong> {{ $order->paper_size }}</p>
                                <p><strong>Binding Style:</strong> {{ $order->binding_style }}</p>
                                <p><strong>Cover Color:</strong> {{ $order->cover_colour }}</p>
                                <p><strong>Print Type:</strong> {{ $order->print_color === 'bw' ? 'Black and White' : 'Color' }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                                <p><strong>Page Count:</strong> {{ $order->page_count }}</p>
                                <p><strong>Total Cost:</strong> RM{{ number_format($order->base_cost, 2) }}</p>
                                <p><strong>Shipping:</strong> {{ $order->formatted_shipping_option }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-progress {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 20px 0;
}

.tracking-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    text-align: center;
    position: relative;
}

.tracking-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    border: 2px solid #dee2e6;
    overflow: hidden;
}

.status-icon {
    width: 30px;
    height: 30px;
    object-fit: contain;
}

.inactive-icon {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #dee2e6;
}

.tracking-step.active .tracking-icon {
    background-color: #fff;
    border-color: #28a745;
}

.tracking-step.current .tracking-icon {
    border-color: #007bff;
    background-color: #fff;
}

.tracking-label {
    font-size: 0.85rem;
    color: #6c757d;
    max-width: 120px;
}

.tracking-step.active .tracking-label,
.tracking-step.current .tracking-label {
    color: #212529;
    font-weight: 500;
}

.tracking-line {
    flex: 1;
    height: 2px;
    background-color: #dee2e6;
    margin: 0 10px;
    margin-bottom: 30px;
}

.tracking-line.active {
    background-color: #28a745;
}

.order-details {
    border-top: 1px solid #dee2e6;
    padding-top: 20px;
}
</style>
@endsection
