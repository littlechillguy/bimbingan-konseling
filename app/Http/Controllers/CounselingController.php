<?php

namespace App\Http\Controllers;

use App\Models\CounselingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CounselingController extends Controller
{
    /**
     * Menampilkan halaman Monitoring & Tindak Lanjut
     */
    public function tindakLanjut()
    {
        $requests = CounselingRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->get();

        $completedRequests = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(6)
            ->get();

        return view('admin.layanan.tindak-lanjut', compact('requests', 'scheduledRequests', 'completedRequests'));
    }

    /**
     * Digunakan oleh Siswa untuk mengirim keluhan/permohonan
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'urgency' => 'required',
            'whatsapp' => 'required|numeric',
            'message' => 'required|min:4',
            'other_category' => 'required_if:category,Lainnya', 
        ]);

        $finalCategory = ($request->category === 'Lainnya') 
                         ? $request->other_category 
                         : $request->category;

        $cleanMessage = $this->filterBadWords($request->message);

        CounselingRequest::create([
            'user_id' => Auth::id(),
            'category' => $finalCategory, 
            'urgency' => $request->urgency,
            'whatsapp' => $request->whatsapp, 
            'message' => $cleanMessage,
            'status' => 'pending',
        ]);

        return redirect()->route('layanan.konseling')->with('success', 'Permohonan konseling berhasil dikirim!');
    }

    /**
     * Update Jadwal & Redirect ke WhatsApp untuk Notifikasi
     */
    public function update(Request $request, $id)
    {
        $item = CounselingRequest::with('user')->findOrFail($id);

        $request->validate([
            'service_type' => 'required',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
        ]);

        $item->update([
            'service_type' => $request->service_type,
            'scheduled_date' => $request->scheduled_date,
            'scheduled_time' => $request->scheduled_time,
            'status' => 'scheduled', 
        ]);

        // Persiapan Pesan WA
        $namaSiswa = $item->user->name;
        $jenisLayanan = str_replace('_', ' ', strtoupper($request->service_type));
        $tanggal = Carbon::parse($request->scheduled_date)->format('d-m-Y');
        $jam = $request->scheduled_time;

        $pesan = "Halo *{$namaSiswa}*,\n\nIni adalah konfirmasi jadwal konseling Anda:\n" .
                 "Layanan: *{$jenisLayanan}*\n" .
                 "Tanggal: *{$tanggal}*\n" .
                 "Jam: *{$jam} WIB*\n\n" .
                 "Mohon hadir di ruang BK tepat waktu. Terima kasih.";

        $noWa = preg_replace('/[^0-9]/', '', $item->whatsapp);
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        } elseif (!str_starts_with($noWa, '62')) {
            $noWa = '62' . $noWa;
        }

        return redirect()->away("https://wa.me/{$noWa}?text=" . urlencode($pesan));
    }

    /**
     * Menyelesaikan sesi yang sedang berjalan
     */
    public function complete($id)
    {
        $item = CounselingRequest::findOrFail($id);
        $item->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Sesi konseling telah berhasil diselesaikan!');
    }

    /**
     * Menghapus data permohonan/antrean
     */
    public function destroy($id)
    {
        $item = CounselingRequest::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data antrean berhasil dihapus.');
    }

    /**
     * Sensor Kata Kasar
     */
    private function filterBadWords($text)
    {
        $badWords = [
            'anjing', 'babi', 'monyet', 'bangsat', 'tolol', 'goblok', 'idiot', 
            'perek', 'lonte', 'kontol', 'memek', 'jembut', 'asu', 'bajingan', 'puki'
        ];

        foreach ($badWords as $word) {
            $replacement = substr($word, 0, 1) . str_repeat('*', strlen($word) - 2) . substr($word, -1);
            $text = preg_replace("/\b$word\b/i", $replacement, $text);
        }

        return $text;
    }
}