<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CareerExploration;
use App\Models\CounselingRequest;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Kolaborasi;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * DASHBOARD: Menampilkan antrean baru & jadwal aktif
     */
    public function index()
    {
        // 1. Ambil Antrean Baru (Pending)
        $requests = CounselingRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Ambil Jadwal yang Sedang Berjalan (Scheduled)
        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->orderBy('scheduled_time', 'asc')
            ->get();

        $totalSiswa = User::where('role', 'siswa')->count();
        $kolaborators = \App\Models\Kolaborasi::latest()->get();

        return view('admin.dashboard', compact('requests', 'scheduledRequests', 'totalSiswa', 'kolaborators'));
    }

    public function siswaIndex()
    {
        // Mengambil semua user dengan role siswa
        $siswas = \App\Models\User::where('role', 'siswa')
            ->latest()
            ->paginate(10); // Gunakan paginate agar tidak berat jika siswa banyak

        return view('admin.siswa', compact('siswas'));
    }

    public function siswaShow($id)
    {
        // Cari siswa atau gagalkan jika tidak ada
        $siswa = \App\Models\User::where('role', 'siswa')->findOrFail($id);

        // Perbaikan di sini: Gunakan CounselingRequest (sesuai import di atas) 
        // atau Counseling (pastikan huruf C besar)
        $history = \App\Models\CounselingRequest::where('user_id', $id)->latest()->get();

        return view('admin.siswa.show', compact('siswa', 'history'));
    }

    /**
     * HALAMAN JADWAL: Monitoring jadwal aktif & Ringkasan Riwayat
     */
    public function jadwal()
    {
        // 1. Ambil data yang sudah dijadwalkan (scheduled)
        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->get();

        // 2. Ambil data untuk Riwayat singkat (completed)
        $completedRequests = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(6)
            ->get();

        return view('admin.jadwal', compact('scheduledRequests', 'completedRequests'));
    }

    /**
     * PROSES KONSELING: Mengubah status menjadi Scheduled & Kirim WA
     * Menggunakan dropdown jam (hour) dan menit (minute)
     */
    public function updateCounseling(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'hour' => 'required',
            'minute' => 'required',
            'type_service' => 'required',
        ]);

        // Menggabungkan Hour dan Minute menjadi format 24 Jam (HH:mm)
        $formattedTime = $request->hour . ':' . $request->minute;

        $counseling = CounselingRequest::with('user')->findOrFail($id);

        $counseling->update([
            'scheduled_date' => $request->date,
            'scheduled_time' => $formattedTime,
            'service_type'   => $request->type_service,
            'status'         => 'scheduled'
        ]);

        // Persiapan data untuk pesan WhatsApp
        $namaSiswa = $counseling->user->name;
        $tglFormat = Carbon::parse($request->date)->translatedFormat('l, d F Y');
        $jenisLayanan = ucwords(str_replace('_', ' ', $request->type_service));

        $pesan = "Halo *{$namaSiswa}*, ini Guru BK SMKN 43 Jakarta.\n\n" .
            "Permohonan konseling kamu telah dijadwalkan pada:\n" .
            "📝 Layanan: *{$jenisLayanan}*\n" .
            "📅 Hari/Tgl: {$tglFormat}\n" .
            "⏰ Jam: {$formattedTime} WIB\n" .
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
     * SELESAIKAN KONSELING: Mengubah status dari Scheduled ke Completed
     */
    public function completeCounseling($id)
    {
        $counseling = CounselingRequest::findOrFail($id);
        $counseling->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Sesi konseling telah selesai dan masuk ke arsip.');
    }

    /**
     * HAPUS JADWAL/ANTREAN
     */
    public function destroyCounseling($id)
    {
        $counseling = CounselingRequest::findOrFail($id);
        $counseling->delete();

        return redirect()->back()->with('success', 'Data konseling berhasil dihapus.');
    }

    /**
     * HASIL KONSELING (HALAMAN ARSIP PENUH)
     */
    public function hasilKonseling()
    {
        $requestsDone = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        $manualResults = DB::table('counseling_results')->orderBy('created_at', 'desc')->get();

        return view('admin.layanan.hasil-konseling', compact('requestsDone', 'manualResults'));
    }

    /**
     * SIMPAN CATATAN MANUAL HASIL KONSELING
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

    // ... method index, minatKarir, dll ...

    /**
     * Simpan data kolaborasi baru
     */
    public function storeKolaborasi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'deskripsi' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            // Simpan di folder public/logos
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Kolaborasi::create([
            'nama' => $request->nama,
            'logo' => $logoPath,
            'deskripsi' => $request->deskripsi,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Mitra kolaborasi berhasil ditambahkan!');
    }

    /**
     * Hapus data kolaborasi
     */
    public function destroyKolaborasi($id)
    {
        $collab = Kolaborasi::findOrFail($id);

        if ($collab->logo) {
            Storage::disk('public')->delete($collab->logo);
        }

        $collab->delete();

        return redirect()->back()->with('success', 'Mitra berhasil dihapus.');
    }

    /* --- FITUR HOME VISIT --- */
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

    /**
     * TAMBAHKAN METHOD INI: Untuk memperbarui data Home Visit
     */
    public function updateHomeVisit(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'tanggal_kunjungan' => 'required|date',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);

        DB::table('home_visits')->where('id', $id)->update([
            'nama_siswa' => $request->nama_siswa,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data Home Visit berhasil diperbarui!');
    }

    public function destroyHomeVisit($id)
    {
        DB::table('home_visits')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data Home Visit berhasil dihapus.');
    }

    /* --- FITUR MINAT KARIR --- */
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

    /* --- FITUR PESAN / CHAT --- */
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
