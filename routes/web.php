<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;


use App\Models\User;
use Illuminate\Http\Request;


// Route::post('/login', [AuthController::class, 'login'])->name('actionLogin');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/redirecting', [AuthController::class, 'redirecting'])->name('redirecting');
Route::get('/redirecting', [AuthController::class, 'redirectings'])->name('redirecting');

Route::middleware(['auth'])->group(function(){
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::resource('/kandang-ayam',ProductController::class);
});


