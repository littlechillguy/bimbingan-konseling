<?php

namespace App\Http\Controllers;

use App\Models\CounselingResult;
use Illuminate\Http\Request;

class CounselingResultController extends Controller
{
    /**
     * Menampilkan halaman index dengan data terbaru di atas
     */
    public function index()
    {
        // Menggunakan orderBy agar data yang baru diinput langsung muncul paling atas
        $results = CounselingResult::latest()->get();
        return view('admin.layanan.hasil-konseling', compact('results'));
    }

    /**
     * Menyimpan data baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'jenis_layanan' => 'required',
            'keterangan'    => 'required|min:5',
        ]);

        // Pastikan tidak ada field 'user_id' di sini karena tidak ada di DB
        CounselingResult::create([
            'nama_siswa'    => $request->nama_siswa,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Catatan berhasil disimpan ke arsip!');
    }

    /**
     * Memperbarui data yang sudah ada (Untuk Modal Edit)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_siswa'    => 'required|string|max:255',
            'jenis_layanan' => 'required',
            'keterangan'    => 'required|min:5',
        ]);

        $result = CounselingResult::findOrFail($id);
        $result->update([
            'nama_siswa'    => $request->nama_siswa,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }

    /**
     * Menghapus data
     */
    public function destroy($id)
    {
        $result = CounselingResult::findOrFail($id);
        $result->delete();

        return redirect()->back()->with('success', 'Catatan berhasil dihapus dari arsip.');
    }
}