@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Welcome, {{ Auth::user()->name }}!</h2>

                    <div class="mt-4">
                        <h3>My Orders</h3>
                        @if($orders->count() > 0)
                            @foreach($orders as $order)
                                <div class="order-card mb-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="mb-0">Order #{{ $order->id }}</h5>
                                        <span class="text-muted">{{ $order->created_at->format('d M Y') }}</span>
                                    </div>
                                    
                                    <div class="progress-tracker">
                                        <div class="progress-steps">
                                            <div class="step {{ in_array($order->status, ['order_submitted', 'awaiting_payment', 'payment_verified', 'printing', 'ready_pickup', 'ready_delivery']) ? 'active' : '' }}">
                                                <div class="step-circle">1</div>
                                                <div class="step-label">Order Submitted</div>
                                            </div>
                                            <div class="step {{ in_array($order->status, ['awaiting_payment', 'payment_verified', 'printing', 'ready_pickup', 'ready_delivery']) ? 'active' : '' }}">
                                                <div class="step-circle">2</div>
                                                <div class="step-label">Awaiting Payment</div>
                                            </div>
                                            <div class="step {{ in_array($order->status, ['payment_verified', 'printing', 'ready_pickup', 'ready_delivery']) ? 'active' : '' }}">
                                                <div class="step-circle">3</div>
                                                <div class="step-label">Payment Verified</div>
                                            </div>
                                            <div class="step {{ in_array($order->status, ['printing', 'ready_pickup', 'ready_delivery']) ? 'active' : '' }}">
                                                <div class="step-circle">4</div>
                                                <div class="step-label">Printing</div>
                                            </div>
                                            <div class="step {{ in_array($order->status, ['ready_pickup', 'ready_delivery']) ? 'active' : '' }}">
                                                <div class="step-circle">5</div>
                                                <div class="step-label">{{ $order->shipping_option === 'pickup' ? 'Ready to Pick Up' : 'Ready for Delivery' }}</div>
                                            </div>
                                        </div>
                                        <div class="progress-line">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" 
                                                    style="width: {{ 
                                                        in_array($order->status, ['ready_pickup', 'ready_delivery']) ? '100' : 
                                                        ($order->status === 'printing' ? '80' : 
                                                        ($order->status === 'payment_verified' ? '60' : 
                                                        ($order->status === 'awaiting_payment' ? '40' : 
                                                        ($order->status === 'order_submitted' ? '20' : '0')))) 
                                                    }}%" 
                                                    aria-valuenow="{{ 
                                                        in_array($order->status, ['ready_pickup', 'ready_delivery']) ? '100' : 
                                                        ($order->status === 'printing' ? '80' : 
                                                        ($order->status === 'payment_verified' ? '60' : 
                                                        ($order->status === 'awaiting_payment' ? '40' : 
                                                        ($order->status === 'order_submitted' ? '20' : '0')))) 
                                                    }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-details mt-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if($order->payment_message)
                                                    <div class="alert alert-warning">
                                                        {{ $order->payment_message }}
                                                    </div>
                                                @endif
                                                <small class="text-muted">Order Details:</small>
                                                <ul class="list-unstyled mb-0">
                                                    <li>Paper Size: {{ $order->paper_size }}</li>
                                                    <li>Binding: {{ $order->binding_style }}</li>
                                                    <li>Quantity: {{ $order->quantity }}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <small class="text-muted">Shipping Method:</small>
                                                <p class="mb-0">{{ $order->formatted_shipping_option }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-status mt-3">
                                        <span class="badge {{ 
                                            $order->status == 'ready' ? 'bg-success' : 
                                            ($order->status == 'printing_in_progress' ? 'bg-info' : 
                                            ($order->status == 'payment_verified' ? 'bg-primary' : 
                                            ($order->status == 'awaiting_payment' ? 'bg-warning' : 'bg-secondary'))) 
                                        }}">
                                            {{ $order->formatted_status }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <p class="mb-0">You haven't placed any orders yet.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.order-card {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 1.5rem;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.progress-tracker {
    margin: 2rem 0;
    position: relative;
    padding: 0 1rem;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
    z-index: 2;
}

.step {
    text-align: center;
    color: #6c757d;
    flex: 1;
    padding: 0 10px;
}

.step.active {
    color: #0d6efd;
}

.step-circle {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #fff;
    border: 2px solid #6c757d;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 8px;
}

.step.active .step-circle {
    border-color: #0d6efd;
    background-color: #0d6efd;
    color: #fff;
}

.step-label {
    font-size: 0.75rem;
    font-weight: 500;
    line-height: 1.2;
}

.progress-line {
    position: absolute;
    top: 15px;
    left: 2.5rem;
    right: 2.5rem;
    z-index: 1;
}

.progress {
    height: 4px;
    background-color: #e9ecef;
}

.progress-bar {
    background-color: #0d6efd;
    transition: width 0.6s ease;
}

.badge {
    font-size: 0.875rem;
    padding: 0.5em 1em;
    margin-right: 0.5rem;
}

.order-details {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 6px;
}

.order-details ul li {
    margin-bottom: 0.25rem;
}

@media (max-width: 768px) {
    .step-label {
        font-size: 0.65rem;
    }
    
    .progress-line {
        left: 2rem;
        right: 2rem;
    }
}
</style>
@endsection
