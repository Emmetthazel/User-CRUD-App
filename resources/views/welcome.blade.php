@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-body">
                    <h1 class="display-4 mb-4">Welcome to User Management System</h1>
                    <p class="lead mb-4">A simple and secure way to manage your user account.</p>
                    
                    @guest
                        <div class="d-grid gap-2 d-md-block">
                            <a href="/login" class="btn btn-primary btn-lg me-md-2">Login</a>
                            <a href="/register" class="btn btn-outline-primary btn-lg">Register</a>
                        </div>
                    @else
                        <div class="d-grid gap-2 d-md-block">
                            <a href="/dashboard" class="btn btn-primary btn-lg">Go to Dashboard</a>
                        </div>
                    @endguest
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-shield-alt fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Secure</h5>
                            <p class="card-text">Your data is protected with industry-standard security measures.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-user-cog fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Easy to Use</h5>
                            <p class="card-text">Simple and intuitive interface for managing your account.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <i class="fas fa-sync fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Always Updated</h5>
                            <p class="card-text">Real-time updates and instant access to your information.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 