<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Title sudah disesuaikan agar tidak 'Laravel' lagi --}}
    <title>Lupa Password - Bimbingan Konseling SMKN 43 Jakarta</title>
    
    {{-- Aset Pendukung --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; scroll-behavior: smooth; }
        .glass-card { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
    </style>
</head>
<body class="bg-[#FCFCFC] antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        {{-- Background Gradients --}}
        <div class="absolute top-0 left-0 w-full h-full -z-10 pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-teal-50 rounded-full blur-[120px] opacity-70"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-50 rounded-full blur-[120px] opacity-70"></div>
        </div>

        <div class="max-w-md w-full" x-data="{ show: false }">
            
            {{-- Tombol Beranda --}}
            <div class="flex justify-start mb-6">
                <a href="/" class="group flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-600 shadow-sm hover:shadow-md hover:bg-teal-50 hover:text-teal-700 transition-all active:scale-95">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Beranda
                </a>
            </div>

            {{-- Alert Status Berhasil --}}
            @if (session('status'))
                <div class="mb-6 font-semibold text-sm text-teal-700 bg-teal-50/80 p-4 rounded-2xl border border-teal-100 flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="p-1 bg-white rounded-[2rem] shadow-xl shadow-gray-100">
                        <img src="{{ asset('asset/logo43.png') }}" alt="Logo 43" class="h-16 w-auto object-contain p-2">
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Atur Ulang Sandi</h2>
                <p class="text-gray-500 mt-3 font-medium">Masukkan email akun Anda untuk menerima tautan reset password.</p>
            </div>

            <div class="glass-card p-8 md:p-10 rounded-[2.5rem] border border-white shadow-[0_25px_50px_-12px_rgba(0,0,0,0.04)]">
                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-12 pr-5 py-4 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none placeholder:text-gray-400 @error('email') border-red-500 @enderror"
                                placeholder="Masukkan email terdaftar">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-teal-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path>
                                </svg>
                            </div>
                        </div>

                        {{-- Error Message Handling --}}
                        @if ($errors->has('email'))
                            <div class="mt-3 p-3 bg-red-50 rounded-xl border border-red-100 flex items-start gap-2">
                                <svg class="w-4 h-4 text-red-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-[11px] text-red-600 font-bold leading-tight">
                                    {{ $errors->first('email') == "We can't find a user with that email address." ? "Email tidak terdaftar di sistem kami." : $errors->first('email') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-br from-teal-600 to-emerald-600 text-white rounded-2xl font-bold text-lg hover:shadow-[0_15px_30px_-5px_rgba(13,148,136,0.3)] transition-all active:scale-[0.98]">
                        Kirim Link Reset
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                    <p class="text-gray-500 mb-4 text-sm font-medium">Ingat password Anda?</p>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center w-full px-8 py-4 border-2 border-teal-600 text-teal-600 font-bold rounded-2xl hover:bg-teal-50 transition-all active:scale-[0.98]">
                        Kembali ke Login
                    </a>
                </div>
            </div>

            <div class="text-center mt-8 space-y-1">
                <p class="text-xs text-gray-400 font-semibold tracking-widest uppercase">Bimbingan Konseling</p>
                <p class="text-[10px] text-gray-300 font-medium">Platform Bimbingan Konseling Digital — SMKN 43 Jakarta</p>
            </div>
        </div>
    </div>

</body>
</html>