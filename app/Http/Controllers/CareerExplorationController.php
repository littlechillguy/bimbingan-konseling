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
        'hobi' => 'required|string',
        'pelajaran_favorit' => 'required',
        'work_style' => 'required',
        'career_path' => 'required',
        'cita_cita_keluhan' => 'nullable|string|max:1000', 
    ]);

    CareerExploration::create([
        'user_id' => auth()->id(),
        'hobi' => $request->hobi,
        'pelajaran_favorit' => $request->pelajaran_favorit,
        'work_style' => $request->work_style,
        'career_path' => $request->career_path,
        'cita_cita_keluhan' => $request->cita_cita_keluhan, 
    ]);

    return back()->with('success', 'Data berhasil dikirim!');
}
}