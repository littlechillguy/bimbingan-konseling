<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatAnonimController;
use App\Http\Controllers\CareerExplorationController;
use App\Http\Controllers\CounselingController; 
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
| Authenticated Student Routes (Siswa)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('layanan')->name('layanan.')->group(function () {
        
        // --- FITUR KONSELING UMUM ---
        Route::get('/konseling', function () { 
            return view('layanan.konseling'); 
        })->name('konseling');
        Route::post('/konseling', [CounselingController::class, 'store'])->name('konseling.store');
        
        // --- BIMBINGAN KARIR ---
        Route::get('/bimbingan-karir', function () { 
            return view('layanan.karir'); 
        })->name('karir');
        Route::post('/bimbingan-karir', [CareerExplorationController::class, 'store'])->name('karir.store');

        // --- CHAT ANONIM ---
        Route::get('/chat-anonim', [ChatAnonimController::class, 'index'])->name('chat-anonim');
        Route::post('/chat-anonim', [ChatAnonimController::class, 'store'])->name('chat-anonim.store');
        
        // --- LAYANAN LAINNYA ---
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
| Admin BK Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Manajemen Siswa
    Route::get('/siswa', [AdminController::class, 'siswaIndex'])->name('siswa');
    Route::get('/siswa/{id}', [AdminController::class, 'siswaShow'])->name('siswa.show');
    
    // Fitur Kolaborasi
    Route::post('/kolaborasi', [AdminController::class, 'storeKolaborasi'])->name('kolaborasi.store');
    Route::delete('/kolaborasi/{id}', [AdminController::class, 'destroyKolaborasi'])->name('kolaborasi.destroy');

    // --- FITUR UTAMA KONSELING (TINDAK LANJUT) ---
    Route::get('/layanan/tindak-lanjut', [CounselingController::class, 'tindakLanjut'])->name('layanan.tindak-lanjut');
    
    // Konfirmasi jadwal/kirim WA
    Route::put('/counseling/{id}/update', [CounselingController::class, 'update'])->name('counseling.update');
    
    // Selesaikan sesi (Sesi yang sudah dijadwalkan menjadi Completed)
    Route::patch('/counseling/{id}/complete', [CounselingController::class, 'complete'])->name('counseling.complete');
    
    // Hapus data antrean
    Route::delete('/counseling/{id}', [CounselingController::class, 'destroy'])->name('counseling.delete');

    // --- HASIL KONSELING (RIWAYAT) ---
    // Dipastikan name('hasil-konseling') sesuai dengan link di Blade Admin
    Route::get('/hasil-konseling', [CounselingController::class, 'hasilIndex'])->name('hasil-konseling');
    Route::post('/hasil-konseling', [CounselingController::class, 'storeHasil'])->name('counseling.store-hasil');

    // Manajemen Jadwal & Home Visit
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
    Route::get('/home-visit', [AdminController::class, 'homeVisit'])->name('home-visit');
    Route::post('/home-visit', [AdminController::class, 'storeHomeVisit'])->name('home-visit.store');
    Route::put('/home-visit/{id}', [AdminController::class, 'updateHomeVisit'])->name('home-visit.update');
    Route::delete('/home-visit/{id}', [AdminController::class, 'destroyHomeVisit'])->name('home-visit.destroy');

    // Layanan Minat Karir
    Route::get('/minat-karir', [AdminController::class, 'minatKarir'])->name('minat-karir');
    Route::delete('/minat-karir/{id}', [AdminController::class, 'destroyMinatKarir'])->name('minat-karir.destroy');

    // Chat Anonim Management
    Route::get('/chat', [AdminController::class, 'chatIndex'])->name('chat');
    Route::patch('/chat/{id}/read', [AdminController::class, 'chatRead'])->name('chat.read');
    Route::delete('/chat/{id}', [AdminController::class, 'chatDestroy'])->name('chat.delete');
});

require __DIR__ . '/auth.php';