<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::all(); // Assuming you're fetching all tasks
            return response()->json($tasks);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch tasks'], 500);
        }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Adds a new task to the database
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);
        $task = Task::create($validated);
        return response()->json($task,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Pending,In Progress,Completed',
        ]);
        $task->update($validated);
        return response()->json($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $tsak)
    {
        //
        $task->delete();
        return response()->json(null, 204);
    }
}
