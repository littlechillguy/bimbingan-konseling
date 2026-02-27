<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatAnonimController;
use App\Http\Controllers\CareerExplorationController;
use App\Http\Controllers\CounselingController;
use App\Http\Controllers\CounselingResultController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Redirect Root (Wajib di luar Group)
|--------------------------------------------------------------------------
*/
// Jika user buka domain.com/ langsung dilempar ke domain.com/bk
Route::get('/', function () {
    return redirect('/bk');
});

/*
|--------------------------------------------------------------------------
| 2. BK SYSTEM GROUP (Semua diawali /bk)
|--------------------------------------------------------------------------
*/
Route::prefix('bk')->group(function () {

    /* --- Public Routes --- */
    // URL ini akan menjadi: domain.com/bk
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // URL ini akan menjadi: domain.com/bk/layanan
    Route::get('/layanan', function () {
        return view('layanan');
    })->name('layanan');


    /* --- Authenticated Student Routes (Siswa) --- */
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
            Route::get('/konseling-online', function () {
                return view('layanan.online');
            })->name('online');
            Route::get('/konseling-offline', function () {
                return view('layanan.offline');
            })->name('offline');
        });

        // Tips Sections
        Route::get('/tips-kesehatan-mental', function () {
            return view('tips.stress');
        })->name('tips.stress');
        
        Route::get('/tips-pertemanan-sehat', function () {
            return view('tips.pertemanan');
        })->name('tips.pertemanan');

        // Profile Management
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    /* --- Admin BK Routes --- */
    // URL ini akan menjadi: domain.com/bk/admin/...
    Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // Manajemen Siswa
        Route::get('/siswa', [AdminController::class, 'siswaIndex'])->name('siswa');
        Route::get('/siswa/{id}', [AdminController::class, 'siswaShow'])->name('siswa.show');

        // Fitur Kolaborasi
        Route::post('/kolaborasi', [AdminController::class, 'storeKolaborasi'])->name('kolaborasi.store');
        Route::put('/kolaborasi/{id}', [AdminController::class, 'updateKolaborasi'])->name('kolaborasi.update');
        Route::delete('/kolaborasi/{id}', [AdminController::class, 'destroyKolaborasi'])->name('kolaborasi.destroy');

        // Fitur Utama Konseling
        Route::get('/layanan/tindak-lanjut', [CounselingController::class, 'tindakLanjut'])->name('layanan.tindak-lanjut');
        Route::put('/counseling/{id}/update', [CounselingController::class, 'update'])->name('counseling.update');
        Route::patch('/counseling/{id}/complete', [CounselingController::class, 'complete'])->name('counseling.complete');
        Route::delete('/counseling/{id}', [CounselingController::class, 'destroy'])->name('counseling.delete');

        // Hasil Konseling
        Route::get('/hasil-konseling', [CounselingResultController::class, 'index'])->name('hasil-konseling');
        Route::post('/hasil-konseling', [CounselingResultController::class, 'store'])->name('hasil-konseling.store');
        Route::put('/hasil-konseling/{id}', [CounselingResultController::class, 'update'])->name('hasil-konseling.update');
        Route::delete('/hasil-konseling/{id}', [CounselingResultController::class, 'destroy'])->name('hasil-konseling.destroy');

        // Manajemen Jadwal & Home Visit
        Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
        Route::get('/home-visit', [AdminController::class, 'homeVisit'])->name('home-visit');
        Route::post('/home-visit', [AdminController::class, 'storeHomeVisit'])->name('home-visit.store');
        Route::put('/home-visit/{id}', [AdminController::class, 'updateHomeVisit'])->name('home-visit.update');
        Route::delete('/home-visit/{id}', [AdminController::class, 'destroyHomeVisit'])->name('home-visit.destroy');

        // Layanan Minat Karir
        Route::get('/minat-karir', [AdminController::class, 'minatKarir'])->name('minat-karir');
        Route::delete('/minat-karir/{id}', [AdminController::class, 'destroyMinatKarir'])->name('minat-karir.destroy');

        // Chat Management
        Route::get('/chat', [AdminController::class, 'chatIndex'])->name('chat');
        Route::patch('/chat/{id}/read', [AdminController::class, 'chatRead'])->name('chat.read');
        Route::delete('/chat/{id}', [AdminController::class, 'chatDestroy'])->name('chat.delete');
    });

}); // End of /bk Prefix Group

/*
|--------------------------------------------------------------------------
| 3. Auth Routes (Login, Register, dsb)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';