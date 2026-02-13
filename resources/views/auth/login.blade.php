<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Tenang.id</title>
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
        <div class="absolute top-0 left-0 w-full h-full -z-10 pointer-events-none">
            <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-teal-50 rounded-full blur-[120px] opacity-70"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-50 rounded-full blur-[120px] opacity-70"></div>
        </div>

        <div class="max-w-md w-full" x-data="{ show: false }">
            
            <div class="flex justify-start mb-6">
                <a href="/" class="group flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-600 shadow-sm hover:shadow-md hover:bg-teal-50 hover:text-teal-700 transition-all active:scale-95">
                    <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Beranda
                </a>
            </div>

            @if (session('status'))
                <div class="mb-6 font-semibold text-sm text-teal-700 bg-teal-50/80 p-4 rounded-2xl border border-teal-100 flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="p-1 bg-white rounded-[2rem] shadow-xl shadow-gray-100">
                        <img src="{{ asset('asset/logo43.png') }}" alt="Logo 43" class="h-16 w-auto object-contain p-2">
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h2>
                <p class="text-gray-500 mt-3 font-medium">Silakan masuk ke akun Anda.</p>
            </div>

            <div class="glass-card p-8 md:p-10 rounded-[2.5rem] border border-white shadow-[0_25px_50px_-12px_rgba(0,0,0,0.04)]">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="login" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Username / Email</label>
                        <div class="relative group">
                            <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus
                                class="w-full pl-12 pr-5 py-4 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none placeholder:text-gray-400 @error('login') border-red-500 @enderror"
                                placeholder="Email atau username">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-teal-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        </div>
                        @error('login')
                            <p class="mt-2 text-xs text-red-600 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between mb-2 ml-1">
                            <label for="password" class="text-sm font-bold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-teal-600 font-bold hover:text-teal-700 transition">Lupa?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                class="w-full pl-12 pr-12 py-4 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none placeholder:text-gray-400 @error('password') border-red-500 @enderror"
                                placeholder="••••••••">
                            
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-teal-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>

                            <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600 transition-colors focus:outline-none p-1">
                                <template x-if="!show">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </template>
                                <template x-if="show">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                </template>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center text-sm ml-1">
                        <label for="remember_me" class="flex items-center text-gray-500 cursor-pointer group">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-5 h-5 rounded-lg border-gray-200 text-teal-600 focus:ring-teal-500/20 mr-3 transition-all cursor-pointer">
                            <span class="group-hover:text-gray-700 transition-colors">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-br from-teal-600 to-emerald-600 text-white rounded-2xl font-bold text-lg hover:shadow-[0_15px_30px_-5px_rgba(13,148,136,0.3)] transition-all active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-100 text-center">
                    <p class="text-gray-500 mb-4 text-sm font-medium">Belum punya akun?</p>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center w-full px-8 py-4 border-2 border-teal-600 text-teal-600 font-bold rounded-2xl hover:bg-teal-50 transition-all active:scale-[0.98]">
                        Daftar Akun Baru
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