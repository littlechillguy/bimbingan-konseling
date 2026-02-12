<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'nis' => ['required', 'digits:4'],
            'nisn' => ['required', 'digits:12'],
            'tanggal_lahir' => ['required', 'date'],
            // Tambahkan validasi lain sesuai kebutuhan
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'asal_smp' => $request->asal_smp,
            'is_mutasi' => $request->has('is_mutasi'),
            'riwayat_penyakit' => $request->riwayat_penyakit,
            'nama_orangtua' => $request->nama_orangtua,
            'kontak_siswa' => $request->kontak_siswa,
            'kontak_orangtua' => $request->kontak_orangtua,
            'role' => 'siswa', // Default pendaftar adalah siswa
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
