<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatAnonimController; // Import Controller Baru
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/layanan', function () {
    return view('layanan');
})->name('layanan');


/*
|--------------------------------------------------------------------------
| Authenticated Student Routes (Dashboard & Features)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // Main Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Fitur Konseling (Grouping agar rapi)
    Route::prefix('layanan')->name('layanan.')->group(function () {
        
        // Konseling Pribadi & Karir
        Route::get('/konseling-pribadi', function () {
            return view('layanan.pribadi');
        })->name('pribadi');

        Route::get('/bimbingan-karir', function () {
            return view('layanan.karir');
        })->name('karir');

        // FITUR: Chat Anonim
        // Tampilan Form
        Route::get('/chat-anonim', function () {
            return view('layanan.chat-anonim');
        })->name('chat-anonim');

        // Proses Simpan Pesan (Ini yang tadi menyebabkan error)
        Route::post('/chat-anonim', [ChatAnonimController::class, 'store'])->name('chat-anonim.store');


        // FITUR: Pilihan Metode Konseling
        Route::get('/konseling-online', function () {
            return view('layanan.online');
        })->name('online');

        Route::get('/konseling-offline', function () {
            return view('layanan.offline');
        })->name('offline');
    });

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';