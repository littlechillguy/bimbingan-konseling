<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa - Tenang.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        input[type="date"]::-webkit-calendar-picker-indicator { opacity: 0.4; }
    </style>
</head>
<body class="bg-[#FCFCFC] antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center p-4 md:p-8 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full -z-10 pointer-events-none">
            <div class="absolute top-[-5%] left-[-5%] w-[40%] h-[40%] bg-teal-50 rounded-full blur-[100px] opacity-60"></div>
            <div class="absolute bottom-[-5%] right-[-5%] w-[40%] h-[40%] bg-blue-50 rounded-full blur-[100px] opacity-60"></div>
        </div>

        <div class="max-w-2xl w-full" x-data="{ showPass: false, showConfirm: false }">
            
            <div class="flex justify-start mb-6">
                <a href="/" class="group flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-600 shadow-sm hover:shadow-md hover:bg-teal-50 hover:text-teal-700 transition-all active:scale-95">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Beranda
                </a>
            </div>

            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <div class="p-1 bg-white rounded-2xl shadow-lg shadow-gray-100">
                        <img src="{{ asset('asset/logo43.png') }}" alt="Logo 43" class="h-14 w-auto object-contain p-2">
                    </div>
                </div>
                <h2 class="text-3xl font-black text-gray-900 leading-tight">Daftar Akun Siswa</h2>
                <p class="text-gray-500 mt-2 font-medium text-sm md:text-base">Lengkapi data diri untuk memulai bimbingan.</p>
            </div>

            <div class="glass-card p-6 md:p-10 rounded-[2.5rem] border border-white shadow-[0_25px_50px_-12px_rgba(0,0,0,0.04)]">
                <form method="POST" action="{{ route('register') }}" class="space-y-8">
                    @csrf

                    <div class="space-y-4">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex items-center justify-center w-7 h-7 bg-teal-600 text-white text-xs font-bold rounded-full">1</span>
                            <h3 class="font-bold text-gray-800 tracking-tight">Informasi Akun</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="budi_123">
                                @error('username') <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="Budi Santoso">
                                @error('name') <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Email (Gmail)</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="budi@gmail.com">
                            @error('email') <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex items-center justify-center w-7 h-7 bg-teal-600 text-white text-xs font-bold rounded-full">2</span>
                            <h3 class="font-bold text-gray-800 tracking-tight">Data Akademik & Pribadi</h3>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 ml-1">NIS (4 Digit)</label>
                                <input type="text" name="nis" maxlength="4" value="{{ old('nis') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="1234">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1 ml-1">NISN (12 Digit)</label>
                                <input type="text" name="nisn" maxlength="12" value="{{ old('nisn') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="001234567890">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="Jakarta">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Asal Sekolah SMP/MTS</label>
                            <input type="text" name="asal_smp" value="{{ old('asal_smp') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="Sekolah Asal">
                        </div>

                        <div class="mt-2">
                            <label class="inline-flex items-center gap-3 px-4 py-3 bg-teal-50/50 border border-teal-100 rounded-2xl cursor-pointer hover:bg-teal-50 transition-all w-full md:w-auto">
                                <input type="checkbox" name="is_mutasi" value="1" {{ old('is_mutasi') ? 'checked' : '' }} class="w-5 h-5 rounded-lg border-teal-200 text-teal-600 focus:ring-teal-500/20">
                                <span class="text-sm font-bold text-teal-800">Siswa Mutasi / Pindahan</span>
                            </label>
                        </div>

                        <div class="pt-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1 italic">Riwayat Penyakit (Opsional)</label>
                            <input type="text" name="riwayat_penyakit" value="{{ old('riwayat_penyakit') }}" class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="Misal: Asma (kosongkan jika tidak ada)">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex items-center justify-center w-7 h-7 bg-teal-600 text-white text-xs font-bold rounded-full">3</span>
                            <h3 class="font-bold text-gray-800 tracking-tight">Kontak & Orang Tua</h3>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Nama Orang Tua / Wali</label>
                            <input type="text" name="nama_orangtua" value="{{ old('nama_orangtua') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="Nama ayah/ibu">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1 text-xs text-gray-500 uppercase">WhatsApp Siswa</label>
                                <input type="text" name="kontak_siswa" value="{{ old('kontak_siswa') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="0812xxxx">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1 text-xs text-gray-500 uppercase">WhatsApp Orang Tua</label>
                                <input type="text" name="kontak_orangtua" value="{{ old('kontak_orangtua') }}" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="0857xxxx">
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-gray-50">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="flex items-center justify-center w-7 h-7 bg-teal-600 text-white text-xs font-bold rounded-full">4</span>
                            <h3 class="font-bold text-gray-800 tracking-tight">Keamanan Akun</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Password</label>
                                <div class="relative">
                                    <input :type="showPass ? 'text' : 'password'" name="password" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="••••••••">
                                    <button type="button" @click="showPass = !showPass" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600 transition-colors">
                                        <svg x-show="!showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="showPass" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                                @error('password') <p class="mt-1 text-xs text-red-500 ml-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Konfirmasi Password</label>
                                <div class="relative">
                                    <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required class="w-full px-5 py-3.5 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none" placeholder="••••••••">
                                    <button type="button" @click="showConfirm = !showConfirm" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600 transition-colors">
                                        <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        <svg x-show="showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4 pt-4">
                        <button type="submit" class="w-full py-4 bg-gradient-to-br from-teal-600 to-emerald-600 text-white rounded-2xl font-bold text-lg hover:shadow-[0_15px_30px_-5px_rgba(13,148,136,0.3)] transition-all active:scale-[0.98]">
                            Daftar Siswa Sekarang
                        </button>
                        <a href="{{ route('login') }}" class="w-full py-4 text-center text-teal-600 font-bold hover:bg-teal-50 rounded-2xl transition-all">
                            Sudah punya akun? Masuk di sini
                        </a>
                    </div>
                </form>
            </div>

            <p class="text-center mt-8 text-[11px] text-gray-400 font-semibold tracking-widest uppercase">
                &copy; 2026 TENANG.ID — SMKN 43 JAKARTA
            </p>
        </div>
    </div>
</body>
</html>