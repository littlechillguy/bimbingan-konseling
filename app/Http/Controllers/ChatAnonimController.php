<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Exception;

class ChatAnonimController extends Controller
{
    public function index()
    {
        return view('layanan.chat-anonim');
    }

    public function store(Request $request)
    {
        // 1. Anti-Spam (1 pesan per 1 menit per user/IP)
        $key = 'chat-anonim:' . (Auth::id() ?? $request->ip());
        if (RateLimiter::tooManyAttempts($key, 1)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['error' => "Tunggu $seconds detik lagi untuk mengirim pesan baru."])->withInput();
        }

        // 2. Validasi (Min 4 karakter agar "test" bisa masuk)
        $request->validate([
            'message' => 'required|string|min:4|max:5000',
        ], [
            'message.required' => 'Pesan tidak boleh kosong.',
            'message.min' => 'Ceritakan sedikit lebih banyak (minimal 4 karakter).',
        ]);

        try {
            // 3. Sensor Kata Kasar (Tanpa menolak pesan)
            $filteredMessage = $this->filterBadWords($request->message);

            // 4. Simpan ke Database
            DB::table('messages')->insert([
                'sender_id'    => Auth::id(),
                'message'      => e($filteredMessage), // e() untuk mencegah XSS
                'is_anonymous' => true,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            RateLimiter::hit($key, 60);

            return back()->with('success', 'Pesanmu telah tersampaikan secara anonim ke Guru BK.');

        } catch (Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Gagal mengirim pesan. Silakan coba lagi.']);
        }
    }

    /**
     * Menyensor kata kasar namun tetap mempertahankan huruf pertama dan terakhir
     * agar konteks cerita tetap bisa dipahami oleh konselor.
     */
    private function filterBadWords($text)
    {
        $badWords = [
            'anjing', 'babi', 'monyet', 'bangsat', 'tolol', 'goblok', 'idiot', 
            'perek', 'lonte', 'kontol', 'memek', 'jembut', 'asu', 'bajingan', 'puki', 'setan'
        ];

        foreach ($badWords as $word) {
            $len = strlen($word);
            if ($len <= 2) {
                $replacement = str_repeat('*', $len);
            } else {
                // Contoh: anjing -> a****g
                $replacement = substr($word, 0, 1) . str_repeat('*', $len - 2) . substr($word, -1);
            }
            
            // Regex untuk mengganti kata yang sama persis (case-insensitive)
            $text = preg_replace("/\b$word\b/i", $replacement, $text);
        }

        return $text;
    }
}