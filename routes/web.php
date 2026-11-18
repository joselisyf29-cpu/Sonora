<?php

use App\Http\Controllers\MusicaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MusicaController::class, 'inicio'])->name('inicio');
Route::get('/playlist/{playlist}', [MusicaController::class, 'playlist'])->name('playlist');
Route::get('/reproductor', [MusicaController::class, 'reproductor'])->name('reproductor');
Route::get('/buscar', [MusicaController::class, 'buscar'])->name('buscar');