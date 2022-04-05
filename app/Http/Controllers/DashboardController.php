<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\Task;
use App\Models\User;

class DashboardController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('can:task-view')->only(['tasks', 'trashed']);
//        $this->middleware('can:user-view')->only(['users']);
//    }

    public function tasks()
    {
        return TaskResource::collection(Task::all());
    }

    public function users()
    {
        return UserResource::collection(User::all());
    }

    public function trashed()
    {
        return TaskResource::collection(Task::onlyTrashed()->get());
    }
}
