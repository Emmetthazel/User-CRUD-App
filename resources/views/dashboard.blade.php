@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Welcome, {{ Auth::user()->name }}!</h2>
                    <p class="card-text">This is your personal dashboard where you can manage your account and view your information.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Upcoming Tasks</h4>
                </div>
                <div class="card-body">
                    @if ($upcomingTasks->isEmpty())
                        <p>No upcoming tasks.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($upcomingTasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></h5>
                                        <small class="text-muted">Due: {{ $task->due_date->format('M d, Y') }}</small>
                                    </div>
                                    <span class="badge bg-secondary rounded-pill">
                                        {{ $task->due_date->diffForHumans() }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="mt-3">
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-sm">View All Tasks</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-user-circle"></i> Profile Information
                    </h5>
                    <p class="card-text">
                        <strong>Name:</strong> {{ Auth::user()->name }}<br>
                        <strong>Email:</strong> {{ Auth::user()->email }}
                    </p>
                    <a href="/profile" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-lock"></i> Security
                    </h5>
                    <p class="card-text">Update your password and security settings.</p>
                    <a href="/profile#password" class="btn btn-primary">Change Password</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-cog"></i> Account Settings
                    </h5>
                    <p class="card-text">Manage your account preferences and settings.</p>
                    <a href="/profile#settings" class="btn btn-primary">Manage Settings</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 