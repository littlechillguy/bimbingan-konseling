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
     * DASHBOARD: Menampilkan statistik dengan filter tahun, antrean baru & jadwal aktif
     */
    public function index(Request $request)
    {
        // 1. Ambil tahun unik dari database (kolom scheduled_date) untuk isi dropdown
        $availableYears = CounselingRequest::whereNotNull('scheduled_date')
            ->selectRaw('YEAR(scheduled_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Jika database benar-benar kosong, tampilkan tahun sekarang sebagai pilihan default
        if ($availableYears->isEmpty()) {
            $availableYears = collect([date('Y')]);
        }

        // 2. Ambil tahun dari request (input user), default ke tahun terbaru yang ada di database
        $selectedYear = $request->get('year', $availableYears->first());

        // 3. Logika Grafik (Chart.js)
        $monthlyData = CounselingRequest::selectRaw('MONTH(scheduled_date) as month, COUNT(*) as total')
            ->whereYear('scheduled_date', $selectedYear)
            ->whereNotNull('scheduled_date')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->all();

        // Menyiapkan array 12 bulan (Jan-Des) dengan default 0
        $counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $counts[] = $monthlyData[$i] ?? 0;
        }

        // 4. Data Summary Dashboard
        $requests = CounselingRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->orderBy('scheduled_time', 'asc')
            ->get();

        $totalSiswa = User::where('role', 'siswa')->count();
        $kolaborators = Kolaborasi::latest()->get();

        return view('admin.dashboard', compact(
            'requests',
            'scheduledRequests',
            'totalSiswa',
            'kolaborators',
            'counts',
            'availableYears',
            'selectedYear'
        ));
    }

    public function siswaIndex()
    {
        $siswas = User::where('role', 'siswa')
            ->latest()
            ->paginate(10);

        return view('admin.siswa', compact('siswas'));
    }

    public function siswaShow($id)
    {
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        $history = CounselingRequest::where('user_id', $id)->latest()->get();

        return view('admin.siswa.show', compact('siswa', 'history'));
    }

    public function jadwal()
    {
        $scheduledRequests = CounselingRequest::with('user')
            ->where('status', 'scheduled')
            ->orderBy('scheduled_date', 'asc')
            ->get();

        $completedRequests = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->take(6)
            ->get();

        return view('admin.jadwal', compact('scheduledRequests', 'completedRequests'));
    }

    public function updateCounseling(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'hour' => 'required',
            'minute' => 'required',
            'type_service' => 'required',
        ]);

        $formattedTime = $request->hour . ':' . $request->minute;
        $counseling = CounselingRequest::with('user')->findOrFail($id);

        $counseling->update([
            'scheduled_date' => $request->date,
            'scheduled_time' => $formattedTime,
            'service_type'   => $request->type_service,
            'status'         => 'scheduled'
        ]);

        $namaSiswa = $counseling->user->name ?? $counseling->nama_siswa;
        $tglFormat = Carbon::parse($request->date)->translatedFormat('l, d F Y');
        $jenisLayanan = ucwords(str_replace('_', ' ', $request->type_service));

        $pesan = "Halo *{$namaSiswa}*, ini Guru BK SMKN 43 Jakarta.\n\n" .
            "Permohonan konseling kamu telah dijadwalkan pada:\n" .
            "📝 Layanan: *{$jenisLayanan}*\n" .
            "📅 Hari/Tgl: {$tglFormat}\n" .
            "⏰ Jam: {$formattedTime} WIB\n" .
            "📍 Tempat: Ruang BK\n\n" .
            "Silakan datang tepat waktu ya. Terima kasih.";

        $noWa = $counseling->whatsapp;
        if (str_starts_with($noWa, '0')) {
            $noWa = '62' . substr($noWa, 1);
        }

        $waUrl = "https://wa.me/{$noWa}?text=" . urlencode($pesan);
        return redirect()->away($waUrl);
    }

    public function completeCounseling($id)
    {
        $counseling = CounselingRequest::findOrFail($id);
        $counseling->update(['status' => 'completed']);
        return redirect()->back()->with('success', 'Sesi konseling telah selesai dan masuk ke arsip.');
    }

    public function destroyCounseling($id)
    {
        $counseling = CounselingRequest::findOrFail($id);
        $counseling->delete();
        return redirect()->back()->with('success', 'Data konseling berhasil dihapus.');
    }

    public function hasilKonseling()
    {
        $requestsDone = CounselingRequest::with('user')
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        $manualResults = DB::table('counseling_results')->orderBy('created_at', 'desc')->get();
        return view('admin.layanan.hasil-konseling', compact('requestsDone', 'manualResults'));
    }

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

    public function updateKolaborasi(Request $request, $id)
    {
        $collab = Kolaborasi::findOrFail($id); // Sesuaikan nama model Anda

        $data = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'link' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($collab->logo) {
                Storage::disk('public')->delete($collab->logo);
            }
            $data['logo'] = $request->file('logo')->store('kolaborasi', 'public');
        }

        $collab->update($data);
        return back()->with('success', 'Mitra berhasil diperbarui');
    }

    public function destroyKolaborasi($id)
    {
        $collab = Kolaborasi::findOrFail($id);
        if ($collab->logo) {
            Storage::disk('public')->delete($collab->logo);
        }
        $collab->delete();
        return back()->with('success', 'Mitra berhasil dihapus');
    }

    public function homeVisit()
    {
        $visits = DB::table('home_visits')->orderBy('created_at', 'desc')->get();
        return view('admin.layanan.home-visit', compact('visits'));
    }

    public function storeHomeVisit(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255', // Tambahkan validasi
            'tanggal_kunjungan' => 'required|date',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);

        DB::table('home_visits')->insert([
            'nama_siswa' => $request->nama_siswa,
            'nama_orang_tua' => $request->nama_orang_tua, // Tambahkan ini
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data Home Visit berhasil disimpan!');
    }

    public function updateHomeVisit(Request $request, $id)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nama_orang_tua' => 'required|string|max:255', // Tambahkan validasi
            'tanggal_kunjungan' => 'required|date',
            'alamat' => 'required',
            'keterangan' => 'required',
        ]);

        DB::table('home_visits')->where('id', $id)->update([
            'nama_siswa' => $request->nama_siswa,
            'nama_orang_tua' => $request->nama_orang_tua, // Tambahkan ini
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
