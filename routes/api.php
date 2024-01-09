<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\KotakAspirasiController;

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
    Route::patch('/kotas/{id}', [KotakAspirasiController::class, 'update'])->middleware('uploader');
    Route::delete('/kotas/{id}', [KotakAspirasiController::class, 'delete'])->middleware('uploader');
});

Route::get('/kotas', [KotakAspirasiController::class, 'index']);
Route::get('/kotas/{id}', [KotakAspirasiController::class, 'show']);

Route::post('/daftar', [AuthenticationController::class, 'daftar']);
Route::post('/masuk', [AuthenticationController::class, 'masuk']);
