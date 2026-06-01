<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;

Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);

// Pengeluaran routes
use App\Http\Controllers\PengeluaranController;
Route::get('/pengeluaran', [PengeluaranController::class, 'index']);
Route::get('/pengeluaran/{tahun?}/{tanggal?}/{bulan?}', [PengeluaranController::class, 'filterByDate']);
Route::post('/pengeluaran', [PengeluaranController::class, 'store']);
Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy']);
Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update']);
