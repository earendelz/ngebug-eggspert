<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangAPIController;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\VaksinasiAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/users", [UserAPIController::class, 'index']);
Route::get("/users/{id}", [UserAPIController::class, 'show']);
Route::put("/users/{id}", [UserAPIController::class, 'update']);
Route::delete("/users/{id}", [UserAPIController::class, 'destroy']);

Route::post('/register', [UserAPIController::class, 'register'])->name('register');
Route::post('/login', [UserAPIController::class, 'login'])->name('login');
Route::post('/logout', [UserAPIController::class, 'logout'])->middleware('auth:sanctum');


Route::apiResource("gudangku", GudangAPIController::class);
Route::apiResource("user", UserAPIController::class);
Route::apiResource('vaksinasi', VaksinasiAPIController::class);