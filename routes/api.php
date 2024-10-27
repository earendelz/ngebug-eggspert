<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\UserAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("gudangku", GudangAPIController::class);
Route::apiResource("user", UserAPIController::class);
Route::post("/login", [UserAPIController::class, 'signIn']);