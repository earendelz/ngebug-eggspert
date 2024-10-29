<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangAPIController;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\LaporanAyamAPIController;
use App\Http\Controllers\ProductAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("gudangku", GudangAPIController::class);
Route::apiResource("user", UserAPIController::class);
Route::apiResource("laporan-ayam", LaporanAyamAPIController::class);
// Route::get('/laporan-ayam/user_id/{id}', [LaporanAyamAPIController::class, 'getByUserId']);
// Route::POST('/laporan-ayam/user_id/{id}', [LaporanAyamAPIController::class, 'getByUserId']);
Route::get('/laporan-ayam/user/{username}', action: [LaporanAyamAPIController::class, 'getByUsername']); //buat manggil API berdasar username
Route::post("/login", [UserAPIController::class, 'signIn']);
Route::apiResource("products", ProductAPIController::class);
