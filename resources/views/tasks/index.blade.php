@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">My Tasks</h4>
                    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm">Add New Task</a>
                </div>
                <div class="card-body">
                    {{-- Filtering and Sorting Controls --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form action="{{ route('tasks.index') }}" method="GET" class="form-inline">
                                <label for="statusFilter" class="me-2">Filter by Status:</label>
                                <select name="status" id="statusFilter" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Pending</option>
                                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-6 text-md-end">
                             <form action="{{ route('tasks.index') }}" method="GET" class="form-inline">
                                {{-- Preserve existing filter --}}
                                @if(request('status') !== null)
                                    <input type="hidden" name="status" value="{{ request('status') }}">
                                @endif

                                <label for="sortBy" class="me-2">Sort by:</label>
                                <select name="sort_by" id="sortBy" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                    <option value="created_at" {{ request('sort_by', 'created_at') == 'created_at' ? 'selected' : '' }}>Created At</option>
                                    <option value="due_date" {{ request('sort_by') == 'due_date' ? 'selected' : '' }}>Due Date</option>
                                    <option value="title" {{ request('sort_by') == 'title' ? 'selected' : '' }}>Title</option>
                                </select>

                                <label for="sortOrder" class="me-2 ms-2">Order:</label>
                                <select name="sort_order" id="sortOrder" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                    <option value="desc" {{ request('sort_order', 'desc') == 'desc' ? 'selected' : '' }}>Descending</option>
                                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                </select>
                             </form>
                        </div>
                    </div>

                    @if ($tasks->isEmpty())
                        <p>You have no tasks yet. Why not create one?</p>
                    @else
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5><a href="{{ route('tasks.show', $task) }}">{{ $task->title }}</a></h5>
                                        <p class="mb-0">{{ Str::limit($task->description, 50) }}</p>
                                        @if ($task->due_date)
                                            <small class="text-muted">Due: {{ $task->due_date->format('M d, Y') }}</small>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-{{ $task->completed ? 'success' : 'secondary' }} rounded-pill me-2">
                                            {{ $task->completed ? 'Completed' : 'Pending' }}
                                        </span>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-secondary me-1"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        {{-- Pagination Links --}}
                        <div class="mt-3">
                            {{ $tasks->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 