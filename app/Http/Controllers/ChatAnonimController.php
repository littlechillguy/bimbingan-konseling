<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatAnonimController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // Simpan ke tabel messages (sesuai struktur SQL yang dibuat sebelumnya)
        DB::table('messages')->insert([
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'is_anonymous' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Pesan anonim kamu sudah terkirim ke Guru BK!');
    }
}