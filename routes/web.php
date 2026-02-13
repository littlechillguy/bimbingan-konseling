<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController; // WAJIB DITAMBAHKAN
use Illuminate\Support\Facades\Route;

// Mengarahkan halaman depan ke home.blade.php
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman Utama Layanan
Route::get('/layanan', function () {
    return view('layanan'); // Sesuaikan dengan nama file blade layanan kamu
})->name('layanan');

// Halaman Detail Konseling Pribadi
Route::get('/layanan/konseling-pribadi', function () {
    return view('layanan.pribadi'); // Folder 'layanan', file 'pribadi.blade.php'
})->name('layanan.pribadi');

// Halaman Detail Bimbingan Karir
Route::get('/layanan/bimbingan-karir', function () {
    return view('layanan.karir'); // Folder 'layanan', file 'karir.blade.php'
})->name('layanan.karir');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
