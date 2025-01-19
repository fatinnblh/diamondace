@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Summary</h1>
    
    <div class="order-details">
        <h2>Order ID: {{ $order->id }}</h2>
        <p><strong>File Path:</strong> {{ $order->file_path }}</p>
        <p><strong>Paper Size:</strong> {{ $order->paper_size }}</p>
        <p><strong>Binding Style:</strong> {{ $order->binding_style }}</p>
        <p><strong>Cover Colour:</strong> {{ $order->cover_colour }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Page Count:</strong> {{ $order->page_count }}</p>
        <p><strong>Base Cost (RM):</strong> {{ number_format($order->base_cost, 2) }}</p>
        <p><strong>Shipping Option:</strong> {{ $order->shipping_option }}</p> 
        <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p> 
    </div>

    @if($order->payment_method == 'qr_code')
        <div class="qr-code">
            <h3>QR Code</h3>
            <img src="{{ asset('path/to/qr/code.png') }}" alt="QR Code" />
            <label for="receipt_upload">Upload Receipt:</label>
            <input type="file" name="receipt_upload" id="receipt_upload" class="rounded-input" onchange="previewFile()">
            <div id="preview"></div>
        </div>
    @endif

    @if($order->shipping_option == 'delivery')
        <a href="{{ route('delivery.address.form', ['order_id' => $order->id]) }}" class="btn btn-primary">Continue</a>
    @else
        <a href="{{ route('pickup.address.form', ['order_id' => $order->id]) }}" class="btn btn-primary">Continue</a>
    @endif

    <div class="file-placeholder">
        <h3>File Placeholder</h3>
        <p>Your uploaded file is available at: <strong>{{ $order->file_path }}</strong></p>
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
</script>
@endsection