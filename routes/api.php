<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KotakAspirasiController;
use App\Http\Controllers\AuthenticationController;

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
    Route::get('/aku', [AuthenticationController::class, 'aku']);
    Route::post('/kotas', [KotakAspirasiController::class, 'create']);
    Route::patch('/kotas/{id}', [KotakAspirasiController::class, 'update'])->middleware('kotas');
    Route::delete('/kotas/{id}', [KotakAspirasiController::class, 'delete'])->middleware('kotas');
    Route::post('/produk', [ProdukController::class, 'create']);
    Route::patch('/produk/{id}', [ProdukController::class, 'update'])->middleware('produk');
    Route::delete('/produk/{id}', [ProdukController::class, 'delete'])->middleware('produk');
    Route::get('/transaksi', [TransaksiController::class, 'show'])->middleware('trans');
    Route::post('/transaksi/{id}', [TransaksiController::class, 'create'])->middleware('trans');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'delete'])->middleware('trans');
});

Route::get('/kotas', [KotakAspirasiController::class, 'index']);
Route::get('/kotas/{id}', [KotakAspirasiController::class, 'show']);
Route::get('/produk', [ProdukController::class, 'index']);
Route::get('/produk/{id}', [ProdukController::class, 'show']);

Route::post('/daftar', [AuthenticationController::class, 'daftar']);
Route::post('/masuk', [AuthenticationController::class, 'masuk']);
