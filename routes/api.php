<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KotakaspirasiController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\TrafficController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/keluar', [AuthenticationController::class, 'keluar']);
    Route::get('/saldo', [AuthenticationController::class, 'saldo']);
    Route::patch('/update/{id}', [AuthenticationController::class, 'update']);
    Route::patch('/updateg/{id}', [AuthenticationController::class, 'updateg']);
    Route::get('/aku', [AuthenticationController::class, 'aku']);
    Route::post('/kotas', [KotakaspirasiController::class, 'create']);
    Route::patch('/kotas/{id}', [KotakaspirasiController::class, 'update'])->middleware('kotas');
    Route::delete('/kotas/{id}', [KotakaspirasiController::class, 'delete'])->middleware('kotas');
    Route::post('/produk', [ProdukController::class, 'create']);
    Route::patch('/produk/{id}', [ProdukController::class, 'update'])->middleware('produk');
    Route::delete('/produk/{id}', [ProdukController::class, 'delete'])->middleware('produk');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->middleware('trans');
    Route::post('/transaksi/{id}', [TransaksiController::class, 'create']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'delete'])->middleware('trans');
    Route::get('/traffic', [TrafficController::class, 'index'])->middleware('traff');
    Route::get('/reward', [TrafficController::class, 'reward'])->middleware('traff');
});

Route::get('/kotas', [KotakaspirasiController::class, 'index']);
Route::get('/kotas/{id}', [KotakaspirasiController::class, 'show']);

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

Route::post('/daftar', [AuthenticationController::class, 'daftar']);
Route::post('/masuk', [AuthenticationController::class, 'masuk']);