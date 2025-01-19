@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Delivery Address</h1>
    <form action="{{ route('payment.method', ['order_id' => $order->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" required class="form-control">
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" required class="form-control">
        </div>
        <div class="form-group">
            <label for="postcode">Postcode:</label>
            <input type="text" name="postcode" id="postcode" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Continue to Payment</button>
    </form>
</div>
@endsection