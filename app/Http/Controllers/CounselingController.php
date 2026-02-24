<?php

namespace App\Http\Controllers;

use App\Models\CounselingRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
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
            'user_id' => auth()->id(),
            'category' => $request->category,
            'urgency' => $request->urgency,
            'whatsapp' => $request->whatsapp, 
            'message' => $request->message,
            'status' => 'pending',
        ]);

        return redirect()->route('layanan.konseling')->with('success', 'Permohonan konseling berhasil dikirim!');
    }

    /**
     * Digunakan oleh Admin BK untuk memproses antrean dari Tindak Lanjut
     * Mengarahkan ke WhatsApp & mengubah status ke 'scheduled'
     */
    public function update(Request $request, $id)
    {
        $item = CounselingRequest::with('user')->findOrFail($id);

        $request->validate([
            'type_service' => 'required',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // 1. Update data di database
        $item->update([
            'service_type' => $request->type_service,
            'scheduled_date' => $request->date,
            'scheduled_time' => $request->time,
            'status' => 'scheduled', 
        ]);

        // 2. Format Pesan WhatsApp
        $namaSiswa = $item->user->name;
        $jenisLayanan = str_replace('_', ' ', strtoupper($request->type_service));
        $tanggal = date('d-m-Y', strtotime($request->date));
        $jam = $request->time;

        $pesan = "Halo *{$namaSiswa}*,\n\n";
        $pesan .= "Permintaan konseling kamu telah disetujui oleh Guru BK.\n";
        $pesan .= "------------------------------------------\n";
        $pesan .= "Jenis Layanan: *{$jenisLayanan}*\n";
        $pesan .= "Jadwal: *{$tanggal}*\n";
        $pesan .= "Jam: *{$jam} WIB*\n";
        $pesan .= "------------------------------------------\n";
        $pesan .= "Mohon datang tepat waktu ke ruang BK SMKN 43 Jakarta. Terima kasih.";

        // Format nomor WA
        $noWa = $item->whatsapp;
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        } elseif (!str_starts_with($noWa, '62')) {
            $noWa = '62' . $noWa;
        }

        $urlWa = "https://wa.me/{$noWa}?text=" . urlencode($pesan);

        return redirect()->away($urlWa);
    }

    /**
     * Menampilkan halaman Monitoring Tindak Lanjut
     * Memperbaiki error: Undefined variable $requests
     */
    public function tindakLanjut()
    {
        // Ambil data yang masih PENDING (untuk form tindak lanjut)
        $requests = CounselingRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil data yang sudah SCHEDULED (untuk monitoring card)
        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->get();

        // Kirim keduanya ke view
        return view('admin.layanan.tindak-lanjut', compact('requests', 'scheduledRequests'));
    }

    /**
     * Menyelesaikan proses tindak lanjut (Status: Completed)
     */
    public function complete($id)
    {
        $item = CounselingRequest::findOrFail($id);
        $item->update(['status' => 'completed']);

        return redirect()->route('admin.layanan.tindak-lanjut')->with('success', 'Layanan BK telah selesai dilaksanakan.');
    }

    /**
     * Menghapus/Membatalkan permintaan konseling
     */
    public function destroy($id)
    {
        $item = CounselingRequest::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data antrean berhasil dihapus.');
    }
}