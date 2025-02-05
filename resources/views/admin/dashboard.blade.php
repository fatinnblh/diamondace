@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <span>{{ __('Admin Dashboard') }}</span>
                </div>

                <div class="card-body">
                    <div class="alert alert-success mb-4">
                        <h4 class="alert-heading mb-0">Welcome, Admin!</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Quick Actions</h5>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-lg">
                                            <i class="fas fa-shopping-cart mr-2"></i>Manage Orders
                                        </a>
                                        <form action="{{ route('admin.orders.delete.all') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete ALL orders? This action cannot be undone!');">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-lg w-100 mt-3">
                                                <i class="fas fa-trash mr-2"></i>Delete All Orders
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
