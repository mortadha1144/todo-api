<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/users/me', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::delete('users/{user}', function (User $user) {
    $user->delete();
    return response()->json(null, 204);
});

Route::apiResource('todos', TodoController::class)->middleware('auth:sanctum');


// [Posts] routes
// Public routes (no auth)
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show']);

// Protected routes (require auth)
Route::apiResource('posts', PostController::class)
    ->except(['index', 'show']) // Exclude both public routes
    ->middleware('auth:sanctum');

// [Comments] routes
Route::apiResource('comments', CommentController::class)
    ->middleware('auth:sanctum');

// [Likes] routes
Route::apiResource('likes', LikeController::class)
    ->middleware('auth:sanctum');
