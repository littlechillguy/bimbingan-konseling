<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareerExploration; // Pastikan sudah buat Modelnya
use Illuminate\Support\Facades\Auth;

class CareerExplorationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'hobi' => 'required|string|max:255',
            'pelajaran_favorit' => 'required',
            'work_style' => 'required',
            'cita_cita_keluhan' => 'required|string',
        ]);

        CareerExploration::create([
            'user_id' => Auth::id(),
            'hobi' => $request->hobi,
            'pelajaran_favorit' => $request->pelajaran_favorit,
            'work_style' => $request->work_style,
            'cita_cita_keluhan' => $request->cita_cita_keluhan,
        ]);

        return redirect()->back()->with('success', 'Data karir kamu berhasil dikirim ke Guru BK!');
    }
}