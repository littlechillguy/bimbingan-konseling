<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatAnonimController;
use App\Http\Controllers\CareerExplorationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/layanan', function () { return view('layanan'); })->name('layanan');

/*
|--------------------------------------------------------------------------
| Authenticated Student Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('layanan')->name('layanan.')->group(function () {
        // Konseling Umum / Konseling Ahli
        Route::get('/konseling', function () { return view('layanan.konseling-ahli'); })->name('konseling');
        
        // Bimbingan Karir & Eksplorasi
        Route::get('/bimbingan-karir', function () { return view('layanan.karir'); })->name('karir');
        Route::post('/bimbingan-karir', [CareerExplorationController::class, 'store'])->name('karir.store');

        // Chat Anonim
        Route::get('/chat-anonim', function () { return view('layanan.chat-anonim'); })->name('chat-anonim');
        Route::post('/chat-anonim', [ChatAnonimController::class, 'store']);
        
        // Jenis Konseling Lainnya
        Route::get('/konseling-online', function () { return view('layanan.online'); })->name('online');
        Route::get('/konseling-offline', function () { return view('layanan.offline'); })->name('offline');
    });

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin BK Routes (Full Controller Based)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Jadwal Masuk (YANG TADI KEHAPUS)
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
    
    // Home Visit
    Route::get('/home-visit', [AdminController::class, 'homeVisit'])->name('home-visit');
    Route::post('/home-visit', [AdminController::class, 'storeHomeVisit'])->name('home-visit.store');
    Route::put('/home-visit/{id}', [AdminController::class, 'updateHomeVisit'])->name('home-visit.update');
    Route::delete('/home-visit/{id}', [AdminController::class, 'destroyHomeVisit'])->name('home-visit.destroy');

    // Hasil Konseling (Fitur Baru)
    Route::get('/hasil-konseling', [AdminController::class, 'hasilKonseling'])->name('hasil-konseling');
    Route::post('/hasil-konseling', [AdminController::class, 'storeHasilKonseling'])->name('hasil-konseling.store');

    // Minat Karir Siswa
    Route::get('/layanan/minat-karir', [AdminController::class, 'minatKarir'])->name('minat-karir');

    // Chat Anonim Admin
    Route::get('/layanan/chat', [AdminController::class, 'chatIndex'])->name('chat');
    Route::patch('/layanan/chat/{id}/read', [AdminController::class, 'chatRead'])->name('chat.read');
    Route::delete('/layanan/chat/{id}', [AdminController::class, 'chatDestroy'])->name('chat.delete');
});

require __DIR__ . '/auth.php';