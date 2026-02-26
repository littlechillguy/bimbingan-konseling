@extends('layouts.app')

@section('title', 'Pertemanan Sehat - SMKN 43')

@section('content')
<div class="min-h-screen bg-[#FFFBF9] p-6 pt-24 lg:p-12 lg:pt-32">
    <div class="max-w-4xl mx-auto">

        {{-- Back Button --}}
        <div class="mb-8 flex">
            {{-- Tambahkan relative z-10 agar pasti di atas elemen lain --}}
            <a href="{{ route('home') }}#tips" class="relative z-10 inline-flex items-center gap-3 group px-4 py-2 bg-white border border-slate-200 rounded-2xl shadow-sm hover:border-rose-300 hover:shadow-md transition-all duration-300">
                <div class="w-8 h-8 bg-rose-50 rounded-lg flex items-center justify-center text-rose-500 group-hover:bg-rose-500 group-hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none">Kembali</span>
                    <span class="text-[11px] font-bold text-slate-700 leading-tight">Beranda</span>
                </div>
            </a>
        </div>

        {{-- Header Section --}}
        <div class="text-center mb-12">
            <span class="px-4 py-2 bg-rose-100 text-rose-700 rounded-full text-[10px] font-black uppercase tracking-widest">Social Life Guide</span>
            <h1 class="text-4xl font-black text-slate-900 mt-4 mb-2">Circle Sehat, Mental Kuat</h1>
            <p class="text-slate-500 italic">"Kamu adalah rata-rata dari 5 orang terdekatmu." — Pilih mereka dengan bijak.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Main Content: Checklist Support System --}}
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-2">
                        Tanda Support System yang Baik
                        <span class="text-rose-500">✨</span>
                    </h2>

                    <div class="space-y-4">
                        {{-- Point 1 --}}
                        <div class="flex gap-4 p-4 rounded-2xl bg-rose-50/50 border border-rose-100">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm text-lg">🤝</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Saling Menghargai Batasan</h4>
                                <p class="text-xs text-slate-500 mt-1">Mereka paham kalau kamu tidak bisa selalu tersedia 24/7 dan tidak marah saat kamu berkata 'tidak'.</p>
                            </div>
                        </div>

                        {{-- Point 2 --}}
                        <div class="flex gap-4 p-4 rounded-2xl bg-orange-50/50 border border-orange-100">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm text-lg">📣</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Pendengar yang Aktif</h4>
                                <p class="text-xs text-slate-500 mt-1">Saat kamu bicara, mereka mendengarkan bukan untuk membalas, tapi untuk memahami perasaanmu.</p>
                            </div>
                        </div>

                        {{-- Point 3 --}}
                        <div class="flex gap-4 p-4 rounded-2xl bg-amber-50/50 border border-amber-100">
                            <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm text-lg">📈</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Mendukung Pertumbuhanmu</h4>
                                <p class="text-xs text-slate-500 mt-1">Mereka tidak merasa terancam saat kamu sukses, justru mereka yang paling depan merayakannya.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tips Section --}}
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                    <h2 class="text-lg font-black text-slate-900 mb-4">Cara Memulai Pertemanan Sehat</h2>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-3 text-sm text-slate-600">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Jadilah dirimu sendiri (autentik) sejak awal.
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-600">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Tunjukkan apresiasi pada hal-hal kecil yang mereka lakukan.
                        </li>
                        <li class="flex items-center gap-3 text-sm text-slate-600">
                            <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Berani menetapkan batasan (boundaries) jika ada hal yang membuatmu tidak nyaman.
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                {{-- Toxic vs Healthy Check --}}
                <div class="p-6 bg-slate-900 rounded-[2.5rem] text-white">
                    <h3 class="text-sm font-black uppercase tracking-widest mb-4">Red Flag Alerts 🚩</h3>
                    <div class="space-y-3 opacity-80">
                        <div class="text-[10px] p-3 bg-white/10 rounded-xl">Hanya datang saat butuh sesuatu.</div>
                        <div class="text-[10px] p-3 bg-white/10 rounded-xl">Sering membicarakan teman lain di belakangmu.</div>
                        <div class="text-[10px] p-3 bg-white/10 rounded-xl">Membuatmu merasa bersalah saat kamu sibuk.</div>
                    </div>
                </div>

                {{-- Interactive Card --}}
                <div class="p-8 bg-rose-500 rounded-[2.5rem] text-white text-center shadow-lg shadow-rose-200">
                    <p class="text-3xl mb-4">🧡</p>
                    <h3 class="font-black text-lg mb-2">Punya masalah circle?</h3>
                    <p class="text-xs opacity-90 mb-6 leading-relaxed">Toxic friendship bisa bikin lelah mental. Curhat ke Guru BK bisa bantu kamu cari solusinya.</p>
                    <a href="{{ route('layanan.konseling') }}" class="inline-block px-6 py-3 bg-white text-rose-600 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:scale-105 transition-transform">Cerita Yuk!</a>
                </div>
            </aside>

        </div>
    </div>
</div>
@endsection