@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Task Details</h4>
                </div>
                <div class="card-body">
                    <h3>{{ $task->title }}</h3>
                    <p><strong>Description:</strong> {{ $task->description ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge bg-{{ $task->completed ? 'success' : 'secondary' }}">
                            {{ $task->completed ? 'Completed' : 'Pending' }}
                        </span>
                    </p>
                    @if ($task->due_date)
                         <p><strong>Due Date:</strong> {{ $task->due_date->format('M d, Y') }}</p>
                    @endif
                    <p><strong>Created At:</strong> {{ $task->created_at->format('M d, Y H:i A') }}</p>
                    <p><strong>Last Updated:</strong> {{ $task->updated_at->format('M d, Y H:i A') }}</p>
                    
                    <hr>

                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Edit Task</a>
                    
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 