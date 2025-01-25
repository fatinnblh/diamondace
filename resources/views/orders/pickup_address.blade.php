@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Pickup Details</h1>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h5>Pickup Location:</h5>
                        <div class="pickup-address p-3 bg-light rounded">
                            <p class="mb-1"><strong>Diamond Ace Resources</strong></p>
                            <p class="mb-0">No 26 Jalan U 1/1,<br>
                            Taman Universiti,<br>
                            35900 Tanjung Malim,<br>
                            Perak</p>
                        </div>
                    </div>

                    <form action="{{ route('pickup.address.submit', ['order_id' => $order->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="pickup_location" value="No 26 Jalan U 1/1, Taman Universiti, 35900 Tanjung Malim, Perak">
                        
                        <div class="form-group mb-4">
                            <label for="pickup_time" class="form-label">Select Pickup Time:</label>
                            <input type="datetime-local" name="pickup_time" id="pickup_time" required class="form-control" min="{{ date('Y-m-d\TH:i', strtotime('+1 day')) }}">
                            <small class="text-muted">Please select a time at least 24 hours in advance</small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Submit Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.pickup-address {
    border-left: 4px solid #0A2472;
}
</style>
@endsection
