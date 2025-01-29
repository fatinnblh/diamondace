@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Login') }}</div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <h3>Admin Access</h3>
                        <p>Please login with your authorized Google account</p>

                        <a href="{{ route('admin.google.login') }}" class="btn btn-danger btn-lg">
                            <i class="fab fa-google mr-2"></i>Login with Google
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
