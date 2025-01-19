@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pickup Address</h1>
    <form action="{{ route('payment.method', ['order_id' => $order->id]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="pickup_location">Pickup Location:</label>
            <input type="text" name="pickup_location" id="pickup_location" required class="form-control">
        </div>
        <div class="form-group">
            <label for="pickup_time">Pickup Time:</label>
            <input type="datetime-local" name="pickup_time" id="pickup_time" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Continue to Payment</button>
    </form>
</div>
@endsection
