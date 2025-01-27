<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // Filter by status if provided
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        // dump($request->due_date_filter);

        // Filter by due date if provided
        if ($request->has('due_date_filter')) {
            $today = now()->format('Y-m-d');

            switch ($request->due_date_filter) {
                case 'today':
                    $query->whereDate('due_date', $today);
                    break;

                case 'week':
                    $startOfWeek = now()->startOfWeek()->format('Y-m-d');
                    $endOfWeek = now()->endOfWeek()->format('Y-m-d');
                    $query->whereBetween('due_date', [$startOfWeek, $endOfWeek]);
                    break;

                case 'overdue':
                    $query->whereDate('due_date', '<', $today);
                    break;
            }
        }

        $tasks = $query->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'status' => 'in:pending,in-progress,completed',
            'due_date' => 'nullable|date|after_or_equal:today',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
        ]);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        // $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        // $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // $this->authorize('update', $task);
        // dd(2);
        $request->validate([
            'title' => 'required|min:5',
            'status' => 'in:pending,in-progress,completed',
            'due_date' => 'nullable|date',
        ]);
// dd(2);
        $task->update($request->all());
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        // dump(1);
        // $this->authorize('delete', $task);
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
