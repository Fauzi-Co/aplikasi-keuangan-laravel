<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Auth\RegistrationController;

Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']);
Route::put('/kategori/{id}', [KategoriController::class, 'update']);

// Registration
Route::post('/registrasi', [RegistrationController::class, 'register']);
