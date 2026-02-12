@extends('layouts.app')

@section('title', 'BK Digital - Ruang Curhat & Konseling Siswa')

@section('content')
    <section class="relative overflow-hidden pt-16 pb-20 lg:pt-24 lg:pb-32">
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[60%] bg-teal-50 rounded-full blur-3xl opacity-60"></div>
            <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[50%] bg-blue-50 rounded-full blur-3xl opacity-60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 py-1.5 px-4 rounded-full bg-teal-100/50 border border-teal-200 text-teal-700 text-sm font-semibold mb-6 animate-fade-in">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-teal-500"></span>
                        </span>
                        <span>Konselor Online Aktif</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-6xl font-black text-gray-900 leading-[1.1] mb-6">
                        Gak Sendirian, <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-emerald-500">Kami Siap Dengar.</span>
                    </h1>
                    
                    <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Ruang aman untuk siswa bercerita tentang apa saja. Dari masalah belajar, pertemanan, hingga pengembangan diri. Rahasiamu aman bersama kami.
                    </p>

                    <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="group relative px-8 py-4 bg-teal-600 text-white rounded-2xl font-bold transition-all hover:bg-teal-700 hover:shadow-[0_20px_50px_rgba(13,_148,_136,_0.3)] flex items-center justify-center">
                                Masuk ke Panel Siswa
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="px-8 py-4 bg-teal-600 text-white rounded-2xl font-bold transition-all hover:bg-teal-700 hover:shadow-lg flex items-center justify-center">
                                Buat Janji Temu
                            </a>
                            <a href="{{ route('login') }}" class="px-8 py-4 bg-white text-gray-700 border-2 border-gray-100 rounded-2xl font-bold hover:bg-gray-50 hover:border-teal-200 transition-all flex items-center justify-center">
                                Login Siswa
                            </a>
                        @endauth
                    </div>

                    <div class="mt-12 flex flex-wrap justify-center lg:justify-start gap-8">
                        <div>
                            <p class="text-2xl font-bold text-gray-900">500+</p>
                            <p class="text-sm text-gray-500 font-medium">Siswa Terbantu</p>
                        </div>
                        <div class="w-px h-10 bg-gray-200 hidden sm:block"></div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900">100%</p>
                            <p class="text-sm text-gray-500 font-medium">Privasi Terjaga</p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 relative w-full max-w-[500px] lg:max-w-none">
                    <div class="relative z-10 w-full h-[400px] bg-gradient-to-br from-teal-100 to-blue-100 rounded-[2rem] overflow-hidden border-4 border-white shadow-2xl flex items-center justify-center">
                         <span class="text-gray-400 font-medium">Ilustrasi/Foto Siswa Konseling</span>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl flex items-center space-x-4 animate-bounce-slow">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900 italic">"Terima kasih sudah mendengar!"</p>
                            <p class="text-xs text-gray-500">Siswa Kelas XI</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Layanan yang Bisa Kamu Akses</h2>
                <p class="text-gray-600 font-medium">Gak perlu bingung harus mulai dari mana, pilih yang paling sesuai kebutuhanmu.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white p-8 rounded-[2rem] border border-gray-100 hover:border-teal-300 transition-all shadow-sm hover:shadow-xl group">
                    <div class="flex justify-between items-start mb-12">
                        <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <span class="text-gray-300 font-black text-5xl">01</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Konseling Pribadi</h3>
                    <p class="text-gray-500 text-lg">Curhat langsung secara privat dengan Guru BK tentang masalah personal atau emosional tanpa takut diketahui orang lain.</p>
                </div>

                <div class="bg-teal-600 p-8 rounded-[2rem] text-white shadow-lg shadow-teal-200">
                    <div class="flex justify-between items-start mb-12">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="text-white/20 font-black text-5xl">02</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Bimbingan Belajar</h3>
                    <p class="text-teal-50 text-lg">Sulit konsentrasi atau bingung pilih jurusan? Mari kita susun rencana belajar yang asik!</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 hover:border-teal-300 transition-all shadow-sm hover:shadow-xl group">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Konseling Kelompok</h3>
                    <p class="text-gray-500">Diskusi bareng teman-teman dengan topik menarik dipandu oleh konselor profesional.</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 hover:border-teal-300 transition-all shadow-sm hover:shadow-xl group">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-8">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Tes Bakat Minat</h3>
                    <p class="text-gray-500">Kenali potensi dirimu lewat berbagai instrumen psikologi yang menyenangkan.</p>
                </div>
                
                <div class="bg-emerald-50 p-8 rounded-[2rem] border border-emerald-100 flex flex-col items-center justify-center text-center">
                    <h3 class="text-xl font-bold text-emerald-900 mb-4">Butuh Bantuan Mendesak?</h3>
                    <a href="#" class="text-emerald-600 font-bold hover:underline">Hubungi Guru BK via WhatsApp →</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(-5%); }
        50% { transform: translateY(0); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite;
    }
</style>
@endpush