<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\GudangAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/users", [UserAPIController::class, 'store']);
Route::get("/users", [UserAPIController::class, 'index']);
Route::get("/users/{id}", [UserAPIController::class, 'show']);
Route::put("/users/{id}", [UserAPIController::class, 'update']);
Route::delete("/users/{id}", [UserAPIController::class, 'destroy']);

Route::post('/login', [UserAPIController::class, 'login']);
Route::post('/logout', [UserAPIController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource("gudangku", GudangAPIController::class);
Route::get("gudangku/username/{username}", [GudangAPIController::class, 'getByUsername']);