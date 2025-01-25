@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Delivery Address</h2>
    <form action="{{ route('delivery.address.submit', ['order_id' => $order->id]) }}" method="POST">
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
        <button type="submit" class="btn btn-primary">Submit Order</button>
    </form>
</div>
@endsection