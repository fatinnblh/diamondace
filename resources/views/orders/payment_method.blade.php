@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Payment Method</h1>
    @if($order->payment_method == 'qr_code')
        <div class="qr-code">
            <h3>QR Code</h3>
            <img src="{{ asset('path/to/qr/code.png') }}" alt="QR Code" />
            <label for="receipt_upload">Upload Receipt:</label>
            <input type="file" name="receipt_upload" id="receipt_upload" required class="rounded-input" />
        </div>
    @endif
    <button type="submit" class="btn btn-primary">Submit Payment</button>
</div>
@endsection
