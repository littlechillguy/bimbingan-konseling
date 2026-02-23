<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChatAnonimController; // Import controller chat
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

    // Main Dashboard Student
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

        // FITUR: Chat Anonim (Sisi Siswa)
        Route::get('/chat-anonim', function () {
            return view('layanan.chat-anonim');
        })->name('chat-anonim');

        // Route untuk menyimpan pesan anonim
        Route::post('/chat-anonim', [ChatAnonimController::class, 'store']);

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
| Admin BK Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // --- FITUR CHAT ANONIM ADMIN ---
    
    // 1. Tampilan Utama Chat
    Route::get('/layanan/chat', function () {
        $messages = DB::table('messages')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->select('messages.*', 'users.name as original_name')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.layanan.admin-chat', compact('messages'));
    })->name('chat');

    // 2. Aksi Tandai Dibaca (PATCH)
    Route::patch('/layanan/chat/{id}/read', function ($id) {
        DB::table('messages')->where('id', $id)->update(['is_read' => true]);
        return back()->with('success', 'Pesan telah ditandai sebagai dibaca.');
    })->name('chat.read');

    // 3. Aksi Hapus Pesan (DELETE)
    Route::delete('/layanan/chat/{id}', function ($id) {
        DB::table('messages')->where('id', $id)->delete();
        return back()->with('success', 'Pesan anonim berhasil dihapus permanen.');
    })->name('chat.delete');

    // --- FITUR LAINNYA ---
    // Route::post('/antrean/update/{id}', [AdminController::class, 'updateAntrean'])->name('antrean.update');
});

require __DIR__ . '/auth.php';