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

        Route::post('/konseling-proses', [CounselingController::class, 'store'])->name('konseling.store');
        
        // --- BIMBINGAN KARIR ---
        Route::get('/bimbingan-karir', function () { return view('layanan.karir'); })->name('karir');
        Route::post('/bimbingan-karir-simpan', [CareerExplorationController::class, 'store'])->name('karir.store');

        // --- CHAT ANONIM ---
        Route::get('/chat-anonim', function () { return view('layanan.chat-anonim'); })->name('chat-anonim');
        Route::post('/chat-anonim-kirim', [ChatAnonimController::class, 'store'])->name('chat-anonim.store');
        
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
    
    // Dashboard Admin & Antrean (Menampilkan status 'pending')
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // --- FITUR UTAMA KONSELING (PENJADWALAN, TINDAK LANJUT, & HASIL) ---
    
    // 1. Proses dari Dashboard (Update Jadwal & Kirim WA)
    Route::post('/counseling/{id}/update', [CounselingController::class, 'update'])->name('counseling.update');
    
    // 2. Monitoring Jadwal / Tindak Lanjut (Status 'scheduled')
    Route::get('/layanan/tindak-lanjut', [CounselingController::class, 'tindakLanjut'])->name('layanan.tindak-lanjut');
    
    // 3. Selesaikan Sesi (Status 'scheduled' -> 'completed')
    Route::post('/counseling/{id}/complete', [CounselingController::class, 'complete'])->name('counseling.complete');

    // 4. Hapus/Batalkan Konseling
    Route::delete('/counseling/{id}/delete', [CounselingController::class, 'destroy'])->name('counseling.delete');

    // 5. Catatan Hasil Konseling (Arsip & Input Manual)
    // Sekarang diarahkan ke CounselingController
    Route::get('/hasil-konseling', [CounselingController::class, 'hasilIndex'])->name('hasil-konseling');
    Route::post('/hasil-konseling/store', [CounselingController::class, 'storeHasil'])->name('hasil-konseling.store');

    // --- MANAJEMEN LAINNYA ---
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
    
    // Home Visit
    Route::get('/home-visit', [AdminController::class, 'homeVisit'])->name('home-visit');
    Route::post('/home-visit', [AdminController::class, 'storeHomeVisit'])->name('home-visit.store');
    Route::put('/home-visit/{id}', [AdminController::class, 'updateHomeVisit'])->name('home-visit.update');
    Route::delete('/home-visit/{id}', [AdminController::class, 'destroyHomeVisit'])->name('home-visit.destroy');

    // Layanan Minat Karir
    Route::get('/layanan/minat-karir', [AdminController::class, 'minatKarir'])->name('minat-karir');
    Route::delete('/layanan/minat-karir/{id}', [AdminController::class, 'destroyMinatKarir'])->name('minat-karir.destroy');

    // Chat Anonim Admin
    Route::get('/layanan/chat', [AdminController::class, 'chatIndex'])->name('chat');
    Route::patch('/layanan/chat/{id}/read', [AdminController::class, 'chatRead'])->name('chat.read');
    Route::delete('/layanan/chat/{id}', [AdminController::class, 'chatDestroy'])->name('chat.delete');
});

require __DIR__ . '/auth.php';