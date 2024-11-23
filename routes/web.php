<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\KandangAyamController;
use App\Http\Controllers\GudangTelurController;
use App\Http\Controllers\PanenTelurController;
use App\Http\Controllers\PenjualanTelurController;
use App\Http\Controllers\PenjualanAyamController;
use App\Http\Controllers\VaksinasiAyamController;
use App\Http\Controllers\LaporanAyamController;
use App\Http\Controllers\LaporanGudangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FileImportExportController;


use App\Models\User;
use Illuminate\Http\Request;


// Route::post('/login', [AuthController::class, 'login'])->name('actionLogin');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/redirecting', [AuthController::class, 'redirecting'])->name('redirecting');

Route::middleware(['auth'])->group(function(){
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::resource('/kandang-ayam-dashboard',KandangAyamController::class);
    Route::resource('/gudang-telur-dashboard',GudangTelurController::class);
    Route::resource('/panen-telur-dashboard',PanenTelurController::class);
    Route::resource('/penjualan-telur-dashboard',PenjualanTelurController::class);
    Route::resource('/penjualan-ayam-dashboard',PenjualanAyamController::class);
    Route::resource('/vaksinasi-ayam-dashboard',VaksinasiAyamController::class);
    Route::resource('/laporan-ayam-dashboard',LaporanAyamController::class);
    Route::resource('/laporan-gudang-dashboard',LaporanGudangController::class);
    Route::get('/', [BerandaController::class, 'index']);
});

Route::get('/file-import-export', [FileImportExportController::class, 'index']);
    Route::post('/file-import', [FileImportExportController::class, 'import'])->name('file.import');
    Route::get('/file-export', [FileImportExportController::class, 'export'])->name('file.export');

