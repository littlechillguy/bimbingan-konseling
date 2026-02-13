@extends('layouts.app')

@section('title', 'Masuk - Tenang.id')

@section('content')
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 bg-[#FCFCFC] relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full -z-10">
            <div class="absolute top-[-10%] right-[-10%] w-[30%] h-[40%] bg-teal-50 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-[-10%] left-[-10%] w-[30%] h-[40%] bg-blue-50 rounded-full blur-3xl opacity-50">
            </div>
        </div>

        <a href="/"
            class="absolute top-8 left-8 flex items-center text-sm font-semibold text-gray-400 hover:text-teal-600 transition group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali ke Beranda
        </a>

        <div class="max-w-md w-full">
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-100">
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-teal-600 rounded-2xl text-white text-3xl font-bold shadow-xl shadow-teal-100 mb-6">
                    T</div>
                <h2 class="text-3xl font-black text-gray-900 leading-tight">Selamat Datang</h2>
                <p class="text-gray-500 mt-3 font-medium">Masuk dengan Username atau Email kamu.</p>
            </div>

            <div class="bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-2xl shadow-gray-100/50">
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="login" class="block text-sm font-bold text-gray-700 mb-2 ml-1">Username / Email</label>
                        <input id="login" type="text" name="login" :value="old('login')" required autofocus
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-teal-500 focus:bg-white transition outline-none placeholder:text-gray-300 @error('login') border-red-500 @enderror"
                            placeholder="Contoh: budi123 atau budi@email.com">

                        @error('login')
                            <p class="mt-2 text-sm text-red-600 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between mb-2 ml-1">
                            <label for="password" class="text-sm font-bold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs text-teal-600 font-bold hover:underline">Lupa Password?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-teal-500 focus:bg-white transition outline-none placeholder:text-gray-300 @error('password') border-red-500 @enderror"
                            placeholder="••••••••">

                        @error('password')
                            <p class="mt-2 text-sm text-red-600 font-medium ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center text-sm ml-1">
                        <label for="remember_me" class="flex items-center text-gray-500 cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500 mr-2">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full py-4 bg-teal-600 text-white rounded-2xl font-bold text-lg hover:bg-teal-700 transition-all shadow-lg shadow-teal-100 active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </form>

                <div class="mt-8 pt-8 border-t border-gray-50 text-center">
                    <p class="text-gray-500 mb-4 text-sm font-medium">Belum punya akun Tenang.id?</p>
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center justify-center w-full px-8 py-3 border-2 border-teal-600 text-teal-600 font-bold rounded-2xl hover:bg-teal-50 transition-colors">
                        Daftar Akun Baru
                    </a>
                </div>
            </div>

            <p class="text-center mt-8 text-xs text-gray-400 font-medium">
                &copy; 2026 Tenang.id — Platform Bimbingan Konseling Digital.
            </p>
        </div>
    </div>
@endsection