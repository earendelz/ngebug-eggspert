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


