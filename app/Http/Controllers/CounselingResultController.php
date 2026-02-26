<?php

namespace App\Http\Controllers;

use App\Models\CounselingResult;
use Illuminate\Http\Request;

class CounselingResultController extends Controller
{
    public function index()
    {
        $results = CounselingResult::orderBy('created_at', 'desc')->get();
        return view('admin.layanan.hasil-konseling', compact('results'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'jenis_layanan' => 'required',
            'keterangan' => 'required|min:5',
        ]);

        CounselingResult::create([
            'nama_siswa' => $request->nama_siswa,
            'jenis_layanan' => $request->jenis_layanan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Catatan berhasil disimpan!');
    }

    public function destroy($id)
    {
        CounselingResult::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Catatan berhasil dihapus.');
    }
}