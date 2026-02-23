<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // 1. Buat Admin
        User::create([
            'username'      => 'admin',
            'name'          => 'Administrator',
            'email'         => 'admin@school.com',
            'password'      => Hash::make('password123'),
            'role'          => 'admin', // Sesuai enum di gambar
            'nis'           => '0000',
            'nisn'          => '000000000000',
            'tempat_lahir'  => 'Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'is_mutasi'     => 0,
        ]);

        // 2. Buat User Biasa (Siswa)
        User::create([
            'username'         => 'siswa',
            'name'             => 'Raisya Mahatir',
            'email'            => 'budi@student.com',
            'password'         => Hash::make('siswa123'),
            'role'             => 'siswa', // Sesuai enum di gambar
            'nis'              => '1234',
            'nisn'             => '001234567890',
            'tempat_lahir'     => 'Bandung',
            'tanggal_lahir'    => '2008-05-20',
            'asal_smp'         => 'SMPN 1 Bandung',
            'is_mutasi'        => 0,
            'riwayat_penyakit' => 'Tidak ada',
            'nama_orangtua'    => 'Agus Setiawan',
            'kontak_siswa'     => '08123456789',
            'kontak_orangtua'  => '08987654321',
        ]);
    }
}