<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function home(Request $request)
    {
        $status = $request->query('status');

        $tasks = Auth::user()->tasks()->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->paginate(5);;

        $pendingCount = Auth::user()->tasks()->where('status', 'pending')->count();
        $inProgressCount = Auth::user()->tasks()->where('status', 'in_progress')->count();
        $completedCount = Auth::user()->tasks()->where('status', 'completed')->count();

        return view('tasks.home', compact('tasks', 'pendingCount', 'inProgressCount', 'completedCount'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks')->with('status', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks')->with('error', 'Unauthorized access.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task, Request $request)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks')->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks')->with('status', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks')->with('error', 'Unauthorized access.');
        }

        $task->delete();
        return redirect()->route('tasks')->with('status', 'Task deleted successfully!');
    }
}
