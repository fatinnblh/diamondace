@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header bg-danger text-white">
                    <h3>Access Denied</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-danger">
                        <h4>{{ $message ?? 'You are not authorized to access this page.' }}</h4>
                    </div>
                    <p>If you believe this is an error, please contact the system administrator.</p>
                    
                    <div class="mt-3">
                        <a href="{{ route('home') }}" class="btn btn-primary mr-2">
                            Return to Home
                        </a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                Go to Dashboard
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
