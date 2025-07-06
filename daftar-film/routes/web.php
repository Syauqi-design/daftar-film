<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FilmController;

// Saat pertama kali buka aplikasi, arahkan ke login (jika belum login) atau ke dashboard
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Dashboard akan menampilkan daftar film, hanya bisa diakses setelah login
Route::get('/dashboard', [FilmController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route yang hanya bisa diakses oleh user yang sudah login
Route::middleware('auth')->group(function () {
    // Profile user
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD film (hanya admin bisa akses penuh, dicek di FilmController)
    Route::resource('films', FilmController::class);
});

// Route untuk login, register, forgot password, dll.
require __DIR__.'/auth.php';
