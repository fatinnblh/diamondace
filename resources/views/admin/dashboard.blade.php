@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ __('Admin Dashboard') }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('Logout') }}</button>
                    </form>
                </div>

                <div class="card-body">
                    <div class="alert alert-success mb-4">
                        <h4 class="alert-heading mb-0">Welcome, Admin!</h4>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Quick Actions</h5>
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-sm w-100">
                                                Manage Orders
                                            </a>
                                        </li>
                                    </ul>
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
