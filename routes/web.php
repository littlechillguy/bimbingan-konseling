<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatAnonimController;
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
        Route::get('/konseling-pribadi', function () { return view('layanan.pribadi'); })->name('pribadi');
        Route::get('/bimbingan-karir', function () { return view('layanan.karir'); })->name('karir');
        Route::get('/chat-anonim', function () { return view('layanan.chat-anonim'); })->name('chat-anonim');
        Route::post('/chat-anonim', [ChatAnonimController::class, 'store']);
        Route::get('/konseling-online', function () { return view('layanan.online'); })->name('online');
        Route::get('/konseling-offline', function () { return view('layanan.offline'); })->name('offline');
    });

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

    // Jadwal Masuk (Route baru yang Anda minta sebelumnya)
    Route::get('/jadwal', [AdminController::class, 'jadwal'])->name('jadwal');
    
    // --- FITUR CHAT ANONIM ADMIN (Sekarang Menggunakan Controller) ---
    Route::get('/layanan/chat', [AdminController::class, 'chatIndex'])->name('chat');
    Route::patch('/layanan/chat/{id}/read', [AdminController::class, 'chatRead'])->name('chat.read');
    Route::delete('/layanan/chat/{id}', [AdminController::class, 'chatDestroy'])->name('chat.delete');

    // Hasil Konseling
    Route::get('/hasil-konseling', [AdminController::class, 'hasilKonseling'])->name('hasil-konseling');
    Route::post('/hasil-konseling', [AdminController::class, 'storeHasilKonseling'])->name('hasil-konseling.store');
    
    // Home Visit
    Route::get('/home-visit', [AdminController::class, 'homeVisit'])->name('home-visit');
    Route::post('/home-visit', [AdminController::class, 'storeHomeVisit'])->name('home-visit.store');
    Route::put('/home-visit/{id}', [AdminController::class, 'updateHomeVisit'])->name('home-visit.update');
    Route::delete('/home-visit/{id}', [AdminController::class, 'destroyHomeVisit'])->name('home-visit.destroy');
});

require __DIR__ . '/auth.php';