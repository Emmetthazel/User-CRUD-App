<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Auth::user()->tasks();

        // Apply filters
        if ($request->has('status') && $request->status !== '') {
            $tasks->where('completed', $request->status);
        }

        // Apply sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        if (in_array($sortBy, ['created_at', 'due_date', 'title'])) {
            $tasks->orderBy($sortBy, $sortOrder);
        } else {
            $tasks->latest(); // Default sort
        }

        // Paginate the results
        $tasks = $tasks->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'nullable|date',
        ]);

        $incomingData['user_id'] = Auth::id();

        Task::create($incomingData);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $incomingData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'completed' => 'boolean',
            'due_date' => 'nullable|date',
        ]);

        $task->update($incomingData);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }
}
