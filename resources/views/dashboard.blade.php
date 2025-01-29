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
                        <h3>Your Profile</h3>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        
                        @if(Auth::user()->google_id)
                        <div class="mt-3">
                            <h4>Google Account</h4>
                            <p>Connected</p>
                            <form method="POST" action="{{ route('google.disconnect') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    Disconnect Google Account
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
