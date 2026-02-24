<?php

namespace App\Http\Controllers;

use App\Models\CounselingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CounselingController extends Controller
{
    /**
     * Menampilkan halaman Monitoring & Tindak Lanjut
     */
    public function tindakLanjut()
    {
        // Ambil data yang masih PENDING (Antrean Masuk)
        $requests = CounselingRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data yang sudah SCHEDULED (Agenda Aktif)
        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->get();

        // --- TAMBAHAN BARU: Ambil data yang COMPLETED (Riwayat) ---
        $completedRequests = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(6) // Ambil 6 riwayat terbaru saja agar tidak kepanjangan
            ->get();

        // Pastikan completedRequests ikut dikirim ke view
        return view('admin.layanan.tindak-lanjut', compact('requests', 'scheduledRequests', 'completedRequests'));
    }

    /**
     * Digunakan oleh Siswa untuk mengirim keluhan
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'urgency' => 'required',
            'whatsapp' => 'required|numeric',
            'message' => 'required',
        ]);

        CounselingRequest::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'urgency' => $request->urgency,
            'whatsapp' => $request->whatsapp, 
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('layanan.konseling')->with('success', 'Permohonan konseling berhasil dikirim!');
    }

    /**
     * Proses ke WA & Ubah status ke Scheduled
     */
    public function update(Request $request, $id)
    {
        $item = CounselingRequest::with('user')->findOrFail($id);

        $request->validate([
            'type_service' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $item->update([
            'service_type' => $request->type_service,
            'scheduled_date' => $request->date,
            'scheduled_time' => $request->time,
            'status' => 'scheduled', 
        ]);

        $namaSiswa = $item->user->name;
        $jenisLayanan = str_replace('_', ' ', strtoupper($request->type_service));
        $tanggal = date('d-m-Y', strtotime($request->date));
        $jam = $request->time;

        $pesan = "Halo *{$namaSiswa}*,\n\nJadwal konseling Anda: *{$jenisLayanan}* pada *{$tanggal}* jam *{$jam} WIB*. Mohon hadir di ruang BK.";

        $noWa = $item->whatsapp;
        if (str_starts_with($noWa, '0')) $noWa = '62' . substr($noWa, 1);
        elseif (!str_starts_with($noWa, '62')) $noWa = '62' . $noWa;

        return redirect()->away("https://wa.me/{$noWa}?text=" . urlencode($pesan));
    }

    /**
     * Selesaikan Sesi dari halaman Monitoring
     */
    public function complete($id)
    {
        $item = CounselingRequest::findOrFail($id);
        $item->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Sesi konseling telah berhasil diselesaikan!');
    }

    /**
     * Hapus/Batal
     */
    public function destroy($id)
    {
        $item = CounselingRequest::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data antrean berhasil dihapus.');
    }

    // --- BAGIAN HASIL KONSELING ---

    /**
     * Menampilkan Riwayat Hasil Konseling (Halaman Tersendiri)
     */
    public function hasilIndex()
    {
        $results = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->whereNotNull('hasil_akhir')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.layanan.hasil-konseling', compact('results'));
    }

    /**
     * Simpan Catatan Hasil Konseling (Input Manual)
     */
    public function storeHasil(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'jenis_layanan' => 'required',
            'keterangan' => 'required',
        ]);

        CounselingRequest::create([
            'user_id' => Auth::id(), 
            'service_type' => $request->jenis_layanan,
            'hasil_akhir' => $request->keterangan,
            'status' => 'completed',
            'message' => 'Catatan: ' . $request->nama_siswa, 
            'whatsapp' => '0', 
            'category' => 'Lainnya',
            'urgency' => 'Normal'
        ]);

        return redirect()->back()->with('success', 'Catatan hasil konseling berhasil disimpan!');
    }
}