<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangAPIController;
use App\Http\Controllers\LaporanAyamAPIController;
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
Route::delete("/users/{id}", [UserAPIController::class, 'destroy']);

Route::post('/register', [UserAPIController::class, 'register'])->name('actionRegister');
Route::post('/login', [UserAPIController::class, 'login'])->name('actionLogin');
Route::post('/logout', [UserAPIController::class, 'logout'])->middleware('auth:sanctum')->name('actionLogout');

Route::middleware(['auth:sanctum'])->group(function(){
    Route::put("/users/{id}", [UserAPIController::class, 'update']);
    Route::get("/users/{id}", [UserAPIController::class, 'show']);
    Route::put("/change-password", [UserAPIController::class, 'changePassword']);
    Route::apiResource("gudangku", GudangAPIController::class);
    Route::apiResource("kandangku", ProductAPIController::class);
    Route::apiResource("pakanku", PakanAPIController::class);
    Route::apiResource("rasayamku", RasAyamAPIController::class);
    Route::apiResource("vaksinasiku", VaksinasiAPIController::class);
    Route::apiResource("laporangudangku", LaporanGudangAPIController::class);
    Route::apiResource("laporanayamku", LaporanAyamAPIController::class);
    Route::apiResource('panentelurku', PanenTelurAPIController::class); 
    Route::get('vaksin/{id}',[VaksinasiAPIController::class, 'showByIDKandang'] );

});

Route::apiResource("user", UserAPIController::class);
Route::apiResource('vaksinasi', VaksinasiAPIController::class);

Route::apiResource('laporan-gudang', LaporanGudangAPIController::class);
Route::get('laporan-gudang/getByNama/{nama_laporan_gudang}', [LaporanGudangAPIController::class, 'getByNamaLaporanGudang']);

// Route::apiResource('pakan', PakanAPIController::class); //general route pakan
// Route::get('pakan/getByJenis/{jenis_pakan}', [PakanAPIController::class, 'getByJenisPakan']); //get pakan by jenis pakan

Route::apiResource('ras_ayam', RasAyamAPIController::class); //general route ras ayam

Route::get('panen_telur/kandang/{id_kandang}', [PanenTelurAPIController::class, 'getByKandang']); //get panen telur by id kandang
Route::get('panen_telur/namaKandang/{name}', [PanenTelurAPIController::class, 'getByNamaKandang']); //get panen telur by nama kandang

