<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Mengarahkan halaman depan ke home.blade.php
Route::get('/', function () {
    return view('home');
})->name('home');

// Route Dashboard (Biasanya untuk User/Admin setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grouping Route yang memerlukan login (Breeze/Jetstream default)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';