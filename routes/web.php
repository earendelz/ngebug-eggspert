<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\AuthController;


use App\Models\User;
use Illuminate\Http\Request;


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/authentication', [AuthController::class, 'signIn'])->name('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeAccount']);

Route::middleware('auth')->group(function(){
    Route::resource('products', ProductController::class);
    Route::resource('gudang', GudangController::class);

    Route::get('/logout', [AuthController::class, 'logout']);
});


