<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('todos', TodoController::class);

Route::delete('users/{user}', function (User $user) {
    $user->delete();
    return response()->json(null, 204);
});
