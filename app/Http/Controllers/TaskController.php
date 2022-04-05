<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return TaskResource::collection($tasks);
    }


    public function create()
    {
        //
    }


    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->normalizedData());

        return new TaskResource($task);
    }


    public function show(Task $task)
    {
        if (auth()->user()->id == $task->user->id) {
            return new TaskResource($task);
        } else
            return response()->json(['error' => 'Unauthorised'], 401);
    }


    public function edit(Task $task)
    {
        //
    }


    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (auth()->user()->id == $task->user->id) {
            $task->update($request->validated());
            return new TaskResource($task);
        } else
            return response()->json(['error' => 'Unauthorised'], 401);
    }


    public function destroy(Task $task)
    {
        if (auth()->user()->id == $task->user->id) {
            $task->delete();
            return response()->json(null, 204);
        } else
            return response()->json(['error' => 'Unauthorised'], 401);
    }

    public function toggleStatus(Task $task)
    {
        if (auth()->user()->id == $task->user->id) {
            $task->toggleStatus()->save();
            return new TaskResource($task);
        } else
            return response()->json(['error' => 'Unauthorised'], 401);
    }
}
