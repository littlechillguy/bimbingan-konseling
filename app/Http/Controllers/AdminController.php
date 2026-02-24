<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CareerExploration; 
use App\Models\CounselingRequest; 
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * DASHBOARD: Hanya menampilkan antrean baru (Pending)
     */
    public function index()
    {
        // Ambil status pending untuk antrean masuk
        $requests = CounselingRequest::with('user')
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $totalSiswa = User::where('role', 'siswa')->count();
        
        return view('admin.dashboard', compact('requests', 'totalSiswa'));
    }

    /**
     * HALAMAN JADWAL: Monitoring jadwal aktif
     */
    public function jadwal()
{
    // 1. Ambil data yang sudah dijadwalkan (scheduled)
    $scheduledRequests = CounselingRequest::with('user')
        ->where('status', 'scheduled')
        ->orderBy('scheduled_date', 'asc')
        ->get();

    // 2. Ambil data untuk Riwayat (completed) - INI YANG KURANG
    $completedRequests = CounselingRequest::with('user')
        ->where('status', 'completed')
        ->orderBy('updated_at', 'desc')
        ->take(6) 
        ->get();

    // 3. Pastikan memanggil view 'admin.jadwal' dan kirim variabelnya
    return view('admin.jadwal', compact('scheduledRequests', 'completedRequests'));
}

    /**
     * PROSES KONSELING: Mengubah status menjadi Scheduled & Kirim WA
     */
    public function updateCounseling(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'type_service' => 'required', // Tambahkan validasi jenis layanan
        ]);

        $counseling = CounselingRequest::with('user')->findOrFail($id);
        
        $counseling->update([
            'scheduled_date' => $request->date,
            'scheduled_time' => $request->time,
            'service_type'   => $request->type_service, // Pastikan kolom ini ada di DB
            'status'         => 'scheduled'
        ]);

        $namaSiswa = $counseling->user->name;
        $tglFormat = Carbon::parse($request->date)->translatedFormat('l, d F Y');
        $jamFormat = $request->time;

        $pesan = "Halo *{$namaSiswa}*, ini Guru BK SMKN 43 Jakarta.\n\n" .
                 "Permohonan konseling kamu telah dijadwalkan pada:\n" .
                 "📅 Hari/Tgl: {$tglFormat}\n" .
                 "⏰ Jam: {$jamFormat} WIB\n" .
                 "📍 Tempat: Ruang BK\n\n" .
                 "Silakan datang tepat waktu ya. Terima kasih.";

        $noWa = $counseling->whatsapp;
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        }

        $waUrl = "https://wa.me/{$noWa}?text=" . urlencode($pesan);

        return redirect()->away($waUrl);
    }

    /**
     * SELESAIKAN KONSELING: Mengubah status menjadi Completed
     * (Fungsi ini dipanggil dari tombol 'Selesai' di halaman jadwal)
     */
    public function completeCounseling($id)
    {
        $counseling = CounselingRequest::findOrFail($id);
        $counseling->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Sesi konseling telah selesai dan masuk ke arsip.');
    }

    /**
     * HAPUS/BATALKAN JADWAL
     */
    public function destroyCounseling($id)
    {
        $counseling = CounselingRequest::findOrFail($id);
        $counseling->delete();

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus.');
    }

    // ... (Fungsi Hasil Konseling, Home Visit, dan Karir tetap sama atau sesuaikan di bawah) ...

    public function hasilKonseling()
    {
        $requestsDone = CounselingRequest::with('user')
                        ->where('status', 'completed')
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $manualResults = DB::table('counseling_results')->orderBy('created_at', 'desc')->get();

        return view('admin.layanan.hasil-konseling', compact('requestsDone', 'manualResults'));
    }

    // ... (Sisa fungsi storeHasilKonseling, homeVisit, minatKarir, chat, dll) ...
}