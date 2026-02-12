<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Tambahkan ini
use App\Models\User; // Tambahkan ini agar tidak error "User unknown"

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin_bk',
            'name' => 'Administrator BK',
            'email' => 'admin@sekolah.com',
            'password' => Hash::make('password123'), // Sekarang ini akan berhasil
            'role' => 'admin',
        ]);
    }
}