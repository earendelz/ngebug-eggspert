<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangAPIController;
use App\Http\Controllers\UserAPIController;
use App\Http\Controllers\VaksinasiAPIController;
use App\Http\Controllers\LaporanGudangAPIController;
use App\Http\Controllers\PakanAPIController;
use App\Http\Controllers\RasAyamAPIController;
use App\Http\Controllers\PanenTelurAPIController;
use App\Http\Controllers\ProductAPIController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/users", [UserAPIController::class, 'index']);
Route::get("/users/{id}", [UserAPIController::class, 'show']);
Route::put("/users/{id}", [UserAPIController::class, 'update']);
Route::delete("/users/{id}", [UserAPIController::class, 'destroy']);

Route::post('/register', [UserAPIController::class, 'register'])->name('register');
Route::post('/login', [UserAPIController::class, 'login'])->name('actionLogin');
Route::post('/logout', [UserAPIController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function(){
    Route::apiResource("gudangku", GudangAPIController::class);
});

Route::apiResource("user", UserAPIController::class);
Route::apiResource('vaksinasi', VaksinasiAPIController::class);

Route::apiResource('laporan-gudang', LaporanGudangAPIController::class);
Route::get('laporan-gudang/getByNama/{nama_laporan_gudang}', [LaporanGudangAPIController::class, 'getByNamaLaporanGudang']);

Route::apiResource('pakan', PakanAPIController::class); //general route pakan
Route::get('pakan/getByJenis/{jenis_pakan}', [PakanAPIController::class, 'getByJenisPakan']); //get pakan by jenis pakan

Route::apiResource('ras_ayam', RasAyamAPIController::class); //genera; route ras ayam

Route::apiResource('panen_telur', PanenTelurAPIController::class); //general route panen telur
Route::get('panen_telur/kandang/{id_kandang}', [PanenTelurAPIController::class, 'getByKandang']); //get panen telur by id kandang
Route::get('panen_telur/namaKandang/{name}', [PanenTelurAPIController::class, 'getByNamaKandang']); //get panen telur by nama kandang

Route::apiResource('kandang', ProductAPIController::class); //general route kandang (products)
