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
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/siswa', [AdminController::class, 'siswaIndex'])->name('siswa');
    Route::get('/siswa/{id}', [AdminController::class, 'siswaShow'])->name('siswa.show');
    
    // --- FITUR KOLABORASI (TAMBAHAN BARU) ---
    Route::post('/kolaborasi/store', [AdminController::class, 'storeKolaborasi'])->name('kolaborasi.store');
    Route::delete('/kolaborasi/{id}', [AdminController::class, 'destroyKolaborasi'])->name('kolaborasi.destroy');

    // --- FITUR UTAMA KONSELING ---
    Route::post('/counseling/{id}/update', [CounselingController::class, 'update'])->name('counseling.update');
    Route::get('/layanan/tindak-lanjut', [CounselingController::class, 'tindakLanjut'])->name('layanan.tindak-lanjut');
    Route::post('/counseling/{id}/complete', [CounselingController::class, 'complete'])->name('counseling.complete');
    Route::delete('/counseling/{id}/delete', [CounselingController::class, 'destroy'])->name('counseling.delete');

    // --- HASIL KONSELING ---
    Route::get('/hasil-konseling', [CounselingController::class, 'hasilIndex'])->name('hasil-konseling');
    Route::post('/hasil-konseling/store', [CounselingController::class, 'storeHasil'])->name('hasil-konseling.store');

    // --- MANAJEMEN LAINNYA ---
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
    
    // Home Visit
    Route::get('/layanan/home-visit', [AdminController::class, 'homeVisit'])->name('home-visit');
    Route::post('/layanan/home-visit', [AdminController::class, 'storeHomeVisit'])->name('home-visit.store');
    Route::put('/layanan/home-visit/{id}', [AdminController::class, 'updateHomeVisit'])->name('home-visit.update');
    Route::delete('/layanan/home-visit/{id}', [AdminController::class, 'destroyHomeVisit'])->name('home-visit.destroy');

    // Layanan Minat Karir
    Route::get('/layanan/minat-karir', [AdminController::class, 'minatKarir'])->name('minat-karir');
    Route::delete('/layanan/minat-karir/{id}', [AdminController::class, 'destroyMinatKarir'])->name('minat-karir.destroy');

    // Chat Anonim Admin
    Route::get('/layanan/chat', [AdminController::class, 'chatIndex'])->name('chat');
    Route::patch('/layanan/chat/{id}/read', [AdminController::class, 'chatRead'])->name('chat.read');
    Route::delete('/layanan/chat/{id}', [AdminController::class, 'chatDestroy'])->name('chat.delete');
});

require __DIR__ . '/auth.php';