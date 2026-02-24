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
        // Hanya ambil status pending agar dashboard bersih dari data yang sudah diproses
        $requests = CounselingRequest::with('user')
                    ->where('status', 'pending')
                    ->orderBy('created_at', 'desc')
                    ->get();

        $totalSiswa = User::where('role', 'siswa')->count();
        
        return view('admin.dashboard', compact('requests', 'totalSiswa'));
    }

    /**
     * PROSES KONSELING: Mengubah status menjadi Scheduled & Kirim WA
     */
    public function updateCounseling(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $counseling = CounselingRequest::with('user')->findOrFail($id);
        
        $counseling->update([
            'scheduled_date' => $request->date,
            'scheduled_time' => $request->time,
            'status' => 'scheduled'
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

        // Format No WA
        $noWa = $counseling->whatsapp;
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        }

        $waUrl = "https://wa.me/{$noWa}?text=" . urlencode($pesan);

        return redirect()->away($waUrl);
    }

    /**
     * HASIL KONSELING (ARSIP): Menampilkan history yang sudah selesai
     */
    public function hasilKonseling()
    {
        // Mengambil data dari CounselingRequest yang statusnya 'completed'
        // digabung dengan data manual dari tabel counseling_results
        $requestsDone = CounselingRequest::with('user')
                        ->where('status', 'completed')
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $manualResults = DB::table('counseling_results')->orderBy('created_at', 'desc')->get();

        return view('admin.layanan.hasil-konseling', compact('requestsDone', 'manualResults'));
    }

    /**
     * SIMPAN CATATAN: Guru BK mengisi hasil akhir konseling
     */
    public function storeHasilKonseling(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'jenis_layanan' => 'required',
            'keterangan' => 'required',
        ]);

        DB::table('counseling_results')->insert([
            'nama_siswa' => $request->nama_siswa,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Catatan hasil konseling berhasil diarsipkan.');
    }

    /* --- FITUR HOME VISIT --- */
    public function homeVisit()
    {
        $visits = DB::table('home_visits')->orderBy('created_at', 'desc')->get();
        return view('admin.layanan.home-visit', compact('visits'));
    }

    public function storeHomeVisit(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);

        DB::table('home_visits')->insert([
            'nama_siswa' => $request->nama_siswa,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data Home Visit berhasil disimpan!');
    }

    public function destroyHomeVisit($id)
    {
        DB::table('home_visits')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Home Visit berhasil dihapus.');
    }

    /* --- FITUR LAINNYA --- */
    public function jadwal()
    {
        return view('admin.jadwal');
    }

    public function minatKarir()
    {
        $dataKarir = CareerExploration::with('user')->latest()->get();
        return view('admin.layanan.minat-karir', compact('dataKarir'));
    }

    public function destroyMinatKarir($id)
    {
        CareerExploration::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data karir dihapus.');
    }

    public function chatIndex()
    {
        $messages = DB::table('messages')
            ->join('users', 'messages.sender_id', '=', 'users.id')
            ->select('messages.*', 'users.name as original_name')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.layanan.admin-chat', compact('messages'));
    }

    public function chatRead($id)
    {
        DB::table('messages')->where('id', $id)->update(['is_read' => true]);
        return back();
    }

    public function chatDestroy($id)
    {
        DB::table('messages')->where('id', $id)->delete();
        return back()->with('success', 'Pesan dihapus.');
    }
}