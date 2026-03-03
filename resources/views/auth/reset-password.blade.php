<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Kata Sandi - BK SMKN 43 Jakarta</title>
    
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

        <div class="max-w-md w-full" x-data="{ showPw: false, showConfirm: false }">
            
            <div class="text-center mb-8">
                <div class="flex justify-center mb-6">
                    <div class="p-1 bg-white rounded-[2rem] shadow-xl shadow-gray-100">
                        <img src="{{ asset('asset/logo43.png') }}" alt="Logo 43" class="h-16 w-auto object-contain p-2">
                    </div>
                </div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Kata Sandi Baru</h2>
                <p class="text-gray-500 mt-3 font-medium px-4">Silakan masukkan kata sandi baru Anda untuk mengamankan akun.</p>
            </div>

            <div class="glass-card p-8 md:p-10 rounded-[2.5rem] border border-white shadow-[0_25px_50px_-12px_rgba(0,0,0,0.04)]">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email Address (ReadOnly agar aman) --}}
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Alamat Email</label>
                        <div class="relative group">
                            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                                class="w-full pl-12 pr-5 py-4 bg-gray-100 border border-gray-100 rounded-2xl text-gray-500 outline-none cursor-not-allowed">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"></path></svg>
                            </div>
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Kata Sandi Baru</label>
                        <div class="relative group">
                            <input id="password" :type="showPw ? 'text' : 'password'" name="password" required
                                class="w-full pl-12 pr-12 py-4 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none placeholder:text-gray-400 @error('password') border-red-500 @enderror"
                                placeholder="Minimal 8 karakter">
                            
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-teal-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>

                            <button type="button" @click="showPw = !showPw" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600 focus:outline-none">
                                <template x-if="!showPw">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </template>
                                <template x-if="showPw">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                </template>
                            </button>
                        </div>
                        @error('password') <p class="mt-2 text-xs text-red-600 font-medium ml-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Konfirmasi Kata Sandi</label>
                        <div class="relative group">
                            <input id="password_confirmation" :type="showConfirm ? 'text' : 'password'" name="password_confirmation" required
                                class="w-full pl-12 pr-12 py-4 bg-gray-50/50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-teal-500/10 focus:border-teal-500 focus:bg-white transition-all outline-none placeholder:text-gray-400"
                                placeholder="Ulangi kata sandi">
                            
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-teal-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>

                            <button type="button" @click="showConfirm = !showConfirm" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-teal-600 focus:outline-none">
                                <template x-if="!showConfirm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </template>
                                <template x-if="showConfirm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"></path></svg>
                                </template>
                            </button>
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-gradient-to-br from-teal-600 to-emerald-600 text-white rounded-2xl font-bold text-lg hover:shadow-[0_15px_30px_-5px_rgba(13,148,136,0.3)] transition-all active:scale-[0.98]">
                        Perbarui Kata Sandi
                    </button>
                </form>
            </div>

            <div class="text-center mt-8 space-y-1">
                <p class="text-xs text-gray-400 font-semibold tracking-widest uppercase">Bimbingan Konseling</p>
                <p class="text-[10px] text-gray-300 font-medium">Platform Bimbingan Konseling Digital — SMKN 43 Jakarta</p>
            </div>
        </div>
    </div>

</body>
</html>