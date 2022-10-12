<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\ProduksiController;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//KANDANG
Route::get('kandang', [KandangController::class, 'index']);
Route::post('/add-kandang', [KandangController::class, 'store']);
Route::get('/edit-kandang/{id}', [KandangController::class, 'edit']);
Route::put('update-kandang/{id}', [KandangController::class, 'update']);
Route::delete('delete-kandang/{id}', [KandangController::class, 'delete']);

//POPULASI
Route::get('produksi', [ProduksiController::class, 'index']);
Route::post('/add-produksi', [ProduksiController::class, 'store']);
Route::get('/edit-produksi/{id}', [ProduksiController::class, 'edit']);
Route::put('update-produksi/{id}', [ProduksiController::class, 'update']);
Route::delete('delete-produksi/{id}', [ProduksiController::class, 'delete']);

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('me', [AuthController::class, 'me']);

});