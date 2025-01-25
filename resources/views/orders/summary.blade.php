@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Summary</h1>
    
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Preview Document</h3>
                    @if(pathinfo($order->file_path, PATHINFO_EXTENSION) === 'pdf')
                        <div class="pdf-container" style="height: 700px;">
                            <object
                                data="{{ $order->file_url }}"
                                type="application/pdf"
                                width="100%"
                                height="100%"
                                style="border: 1px solid #ddd; border-radius: 4px;"
                            >
                                <p>It appears you don't have a PDF plugin for this browser. You can 
                                <a href="{{ $order->file_url }}" target="_blank">click here to download the PDF file</a>.</p>
                            </object>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p>This document is in DOCX format. <a href="{{ $order->file_url }}" class="alert-link" target="_blank">Click here to download</a></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="order-details card">
                <div class="card-body">
                    <h2 class="card-title">Order Details</h2>
                    <div class="order-info mt-3">
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Paper Size:</strong> {{ $order->paper_size }}</p>
                        <p><strong>Binding Style:</strong> {{ $order->binding_style }}</p>
                        <p><strong>Cover Colour:</strong> {{ $order->cover_colour }}</p>
                        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
                        <p><strong>Page Count:</strong> {{ $order->page_count }}</p>
                        <p><strong>Base Cost (RM):</strong> {{ number_format($order->base_cost, 2) }}</p>
                        <p><strong>Shipping Option:</strong> {{ $order->formatted_shipping_option }}</p> 
                        <p><strong>Payment Method:</strong> {{ $order->formatted_payment_method }}</p>
                    </div>

                    @if($order->payment_method == 'qr_code')
                        <div class="qr-code mt-4">
                            <h3>QR Code</h3>
                            <img src="{{ asset('images/qr.jpeg') }}" alt="QR Code" />
                            <form id="receiptForm" action="{{ route('orders.upload.receipt', ['order_id' => $order->id]) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateReceipt()">
                                @csrf
                                <div class="mb-3">
                                    <label for="receipt_upload" class="form-label mt-3">Upload Receipt:<span class="text-danger">*</span></label>
                                    <input type="file" name="receipt_upload" id="receipt_upload" class="form-control" onchange="previewFile()" required accept="image/*">
                                    <div class="invalid-feedback">Please upload your receipt before proceeding.</div>
                                    @error('receipt_upload')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="preview" class="mt-2"></div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ $order->shipping_option == 'delivery' ? 'Continue to Delivery' : 'Continue to Pickup' }}
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="mt-4">
                            @if($order->shipping_option == 'delivery')
                                <a href="{{ route('delivery.address.form', ['order_id' => $order->id]) }}" class="btn btn-primary w-100">Continue to Delivery</a>
                            @else
                                <a href="{{ route('pickup.address.form', ['order_id' => $order->id]) }}" class="btn btn-primary w-100">Continue to Pickup</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewFile() {
    const file = document.querySelector('input[type=file]').files[0];
    const preview = document.getElementById('preview');
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.innerHTML = '<img src="' + reader.result + '" alt="Receipt Preview" style="max-width: 100%; height: auto;" />';
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '';
    }
}

function validateReceipt() {
    const fileInput = document.getElementById('receipt_upload');
    if (!fileInput.files || !fileInput.files[0]) {
        fileInput.classList.add('is-invalid');
        return false;
    }
    return true;
}
</script>

<style>
.order-details {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.pdf-container {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 4px;
}
.order-info p {
    margin-bottom: 0.5rem;
}
.qr-code img {
    max-width: 300px;
    width: 100%;
    height: auto;
    display: block;
    margin: 15px auto;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>
@endsection