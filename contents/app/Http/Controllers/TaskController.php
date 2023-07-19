<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): Collection
    {
        return Task::orderByDesc('id')->get();
    }

    public function store(TaskRequest $request): JsonResponse
    {
        $task = Task::create($request->all());

        return $task
            ? response()->json($task, 201)
            : response()->json([], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    public function update(TaskRequest $request, Task $task): JsonResponse
    {
        $task->title = $request->title;

        return $task->update()
            ? response()->json($task)
            : response()->json([], 500);
    }

    public function destroy(Task $task): JsonResponse
    {
        return $task->delete()
            ? response()->json($task)
            : response()->json([], 500);
    }
}
