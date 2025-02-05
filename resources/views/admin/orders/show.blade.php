@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- Left Side: Order Summary -->
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4">Order Details</h2>
                    <div class="order-info">
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Paper Size:</strong> {{ $order->paper_size }}</p>
                        <p><strong>Cover Colour:</strong> {{ $order->cover_colour }}</p>
                        <p><strong>Print Type:</strong> {{ $order->print_color === 'bw' ? 'Black and White' : 'Color' }}</p>
                        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                        <p><strong>Page Count:</strong> {{ $order->page_count }}</p>
                        <p><strong>Base Cost (RM):</strong> {{ number_format($order->base_cost, 2) }}</p>
                        <p><strong>Shipping Option:</strong> {{ $order->formatted_shipping_option }}</p>
                        <p><strong>Payment Method:</strong> {{ $order->formatted_payment_method }}</p>

                        @if($order->shipping_option === 'delivery')
                        <p><strong>Delivery Address:</strong><br>
                        {{ $order->delivery_address }},<br>
                        {{ $order->delivery_city }},<br>
                        {{ $order->delivery_postcode }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Uploaded Files -->
        <div class="col-md-7">
            <!-- Thesis File -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title mb-4">Uploaded Thesis</h3>
                    @if(pathinfo($order->file_path, PATHINFO_EXTENSION) === 'pdf')
                        <div class="pdf-container" style="height: 600px;">
                            <embed 
                                src="{{ asset('storage/thesis_files/' . basename($order->file_path)) }}" 
                                type="application/pdf"
                                width="100%"
                                height="100%"
                                class="border rounded"
                            >
                        </div>
                    @else
                        <div class="docx-preview text-center p-4">
                            <img src="{{ asset('images/docx-icon.png') }}" alt="DOCX file" class="mb-3" style="width: 64px;">
                            <p class="h5 mb-3">{{ basename($order->file_path) }}</p>
                            <a href="{{ asset('storage/thesis_files/' . basename($order->file_path)) }}" 
                               class="btn btn-primary" 
                               download>
                                Download DOCX
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Receipt -->
            @if($order->receipt_path)
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">Customer Receipt</h3>
                    <button class="receipt-upload" onclick="openReceiptModal()">
                        <span>Receipt Uploaded by Customer</span>
                    </button>
                </div>
            </div>

            @if($order->status == 'order_submitted' || $order->status == 'awaiting_payment')
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="payment-status-container">
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($order->status == 'printing_in_progress')
            <div class="container mt-4">
                <div class="row">
                    <div class="col-12">
                        <div class="ready-status-container">
                            <form method="POST" action="{{ route('admin.orders.update.order.status', $order->id) }}" class="w-100">
                                @csrf
                                <input type="hidden" name="status" value="ready">
                                <div class="status-ready" onclick="this.closest('form').submit()" tabindex="0" role="button" aria-label="Mark as Ready">
                                    <div class="status-text">Mark as Ready</div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Receipt Modal -->
            <div id="receiptModal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeReceiptModal()">&times;</span>
                    <img src="{{ asset('storage/' . $order->receipt_path) }}" 
                         alt="Receipt" 
                         class="modal-receipt-img">
                </div>
            </div>
            @endif
        </div>
    </div>

    @if(auth()->check() && auth()->user()->isAdmin())
    <style>
      .payment-status-container {
        border-radius: 8px;
        display: flex;
        gap: 33px;
        color: var(--Black, #000);
        flex-wrap: nowrap;
        font: 400 16px/1 Inter, sans-serif;
        width: 100%;
        align-items: stretch; /* Ensure equal height */
      }
      .status-incomplete,
      .status-verify {
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        border: 1px solid var(--Black, #000);
        display: flex;
        min-height: 59px;
        gap: 8px;
        flex: 1;
        padding: 18px 24px;
        cursor: pointer;
      }
      .status-text {
        align-self: center;
        white-space: nowrap;
        overflow: visible;
        text-overflow: clip;
        max-width: 100%;
        text-align: center;
      }
      .status-incomplete {
        background-color: #f69697;
      }
      .status-verify {
        background-color: rgba(152, 251, 152, 0.73);
      }
      @media (max-width: 991px) {
        .status-incomplete,
        .status-verify {
          padding: 0 20px;
        }
      }
    </style>
    @endif

    <!-- Status Buttons -->
    <div class="status-container">
        <div class="status-buttons">
            @if($order->status === 'awaiting_payment')
                <form method="POST" action="{{ route('admin.orders.update.payment.status', $order->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="payment_status" value="incomplete">
                    <button type="submit" class="status-button payment-incomplete">
                        Payment Incomplete
                    </button>
                </form>
                @if($order->receipt_path)
                <form method="POST" action="{{ route('admin.orders.update.payment.status', $order->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="payment_status" value="verified">
                    <button type="submit" class="status-button payment-verify">
                        Verify Payment
                    </button>
                </form>
                @endif
            @elseif($order->status === 'payment_verified')
                <form method="POST" action="{{ route('admin.orders.update.order.status', $order->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="printing">
                    <button type="submit" class="status-button payment-verify">
                        Start Printing
                    </button>
                </form>
            @elseif($order->status === 'printing')
                <form method="POST" action="{{ route('admin.orders.update.order.status', $order->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="status" value="ready">
                    <button type="submit" class="status-button payment-verify">
                        Mark as Ready
                    </button>
                </form>
            @elseif($order->status === 'ready_pickup')
                <button class="status-button payment-verify" disabled>
                    Ready for Pickup
                </button>
            @elseif($order->status === 'ready_delivery')
                <button class="status-button payment-verify" disabled>
                    Ready for Delivery
                </button>
            @endif
        </div>
    </div>

    <style>
    .receipt-upload {
        width: 100%;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        border: 1px solid var(--Main-color, #0a2472);
        background-color: #e1ebee;
        display: flex;
        min-height: 59px;
        padding: 18px 24px;
        font: 400 22px/1 Inter, sans-serif;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .receipt-upload:hover {
        background-color: #d1dbe0;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        overflow: auto;
    }

    .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        max-width: 80%;
        max-height: 90vh;
        top: 50%;
        transform: translateY(-50%);
    }

    .modal-receipt-img {
        width: 100%;
        max-height: calc(90vh - 60px);
        object-fit: contain;
    }

    .close {
        position: absolute;
        right: 20px;
        top: 10px;
        color: #0a2472;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover {
        color: #000;
    }

    .status-container {
        display: flex;
        justify-content: center;
        margin-top: 32px;
        width: 100%;
        margin-bottom: 32px;
    }

    .status-buttons {
        display: flex;
        gap: 33px;
        max-width: 812px;
        width: 100%;
        justify-content: center;
    }

    .status-button {
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        border: 1px solid #000;
        display: flex;
        min-height: 59px;
        padding: 18px 24px;
        font: 400 22px/1 Inter, sans-serif;
        cursor: pointer;
        transition: opacity 0.2s;
        min-width: 200px;
    }

    .status-button:disabled {
        cursor: not-allowed;
        opacity: 0.8;
    }

    .payment-incomplete {
        background-color: #F69697;
        cursor: pointer;
    }

    .payment-incomplete:hover {
        opacity: 0.9;
    }

    .payment-verify {
        background-color: #98FB98;
    }

    @media (max-width: 991px) {
        .status-container {
            padding: 0 20px;
        }
    }

    .ready-status-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }

    .status-ready {
        background-color: #28a745;
        color: white;
        padding: 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
    }

    .status-ready:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }
    </style>

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

    function openReceiptModal() {
        document.getElementById('receiptModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
    }

    function closeReceiptModal() {
        document.getElementById('receiptModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restore scrolling
    }

    // Close modal when clicking outside of it
    window.onclick = function(event) {
        var modal = document.getElementById('receiptModal');
        if (event.target == modal) {
            closeReceiptModal();
        }
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeReceiptModal();
        }
    });
    </script>
@endsection
