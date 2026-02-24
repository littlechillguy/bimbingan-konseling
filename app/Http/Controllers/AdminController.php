<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CareerExploration; // Pastikan Model ini di-import

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    /* --- FITUR JADWAL --- */
    public function jadwal()
    {
        return view('admin.layanan.jadwal');
    }

    /* --- FITUR MINAT KARIR (Solusi Error Anda) --- */
    public function minatKarir()
    {
        // Mengambil data eksplorasi karir beserta data user/siswanya
        $dataKarir = CareerExploration::with('user')->latest()->get();
        return view('admin.layanan.minat-karir', compact('dataKarir'));
    }

    /* --- FITUR HASIL KONSELING --- */
    public function hasilKonseling()
    {
        $results = DB::table('counseling_results')->orderBy('created_at', 'desc')->get();
        return view('admin.layanan.hasil-konseling', compact('results'));
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

        return back()->with('success', 'Catatan hasil konseling berhasil disimpan.');
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

        return redirect()->back()->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    public function destroyHomeVisit($id)
    {
        DB::table('home_visits')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Data kunjungan berhasil dihapus!');
    }

    /* --- FITUR CHAT ANONIM --- */
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
        return back()->with('success', 'Pesan telah ditandai sebagai dibaca.');
    }

    public function chatDestroy($id)
    {
        DB::table('messages')->where('id', $id)->delete();
        return back()->with('success', 'Pesan anonim berhasil dihapus permanen.');
    }
}