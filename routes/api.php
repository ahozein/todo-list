<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
});

Route::prefix('v1')->middleware('auth:api')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus']);
});

Route::prefix('v1/dashboard')->middleware(['auth:api', 'admin'])->group(function () {
    Route::get('tasks-list', [DashboardController::class, 'tasks']);
    Route::get('users-list', [DashboardController::class, 'users']);
    Route::get('trashed-tasks', [DashboardController::class, 'trashed']);
});
