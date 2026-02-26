@extends('layouts.app')

@section('title', 'Manajemen Stress Ujian - SMKN 43')

@section('content')
{{-- Padding top pt-24 (mobile) dan pt-32 (desktop) agar tidak tertutup navbar --}}
<div class="min-h-screen bg-[#F0F9FF] p-6 pt-24 lg:p-12 lg:pt-32">
    <div class="max-w-4xl mx-auto">
        
        {{-- Back Button --}}
        <div class="mb-8 flex">
            <a href="{{ route('home') }}#tips" class="relative z-10 inline-flex items-center gap-3 group px-4 py-2 bg-white border border-slate-200 rounded-2xl shadow-sm hover:border-teal-300 hover:shadow-md transition-all duration-300">
                <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-all">
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
            <span class="px-4 py-2 bg-teal-100 text-teal-700 rounded-full text-[10px] font-black uppercase tracking-widest">Self Care Guide</span>
            <h1 class="text-4xl font-black text-slate-900 mt-4 mb-2 tracking-tight">Kelola Stress Musim Ujian</h1>
            <p class="text-slate-500 italic">Ujian itu penting, tapi kesehatan mentalmu jauh lebih berharga. ✨</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Main Content: Grounding Technique --}}
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100" x-data="{ step: 1 }">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">Teknik Grounding 5-4-3-2-1</h2>
                        <span class="text-[10px] font-black text-teal-600 bg-teal-50 px-3 py-1 rounded-lg uppercase tracking-wider" x-text="'Langkah ' + step + ' / 5'"></span>
                    </div>

                    <div class="min-h-[160px] flex flex-col items-center justify-center text-center">
                        <template x-if="step === 1">
                            <div x-transition class="space-y-3">
                                <p class="text-4xl">👀</p>
                                <p class="text-lg font-bold text-slate-700">Sebutkan <span class="text-teal-600 underline decoration-2 underline-offset-4">5 benda</span> yang bisa kamu LIHAT di sekitarmu.</p>
                            </div>
                        </template>
                        <template x-if="step === 2">
                            <div x-transition class="space-y-3">
                                <p class="text-4xl">✋</p>
                                <p class="text-lg font-bold text-slate-700">Sebutkan <span class="text-teal-600 underline decoration-2 underline-offset-4">4 hal</span> yang bisa kamu SENTUH.</p>
                            </div>
                        </template>
                        <template x-if="step === 3">
                            <div x-transition class="space-y-3">
                                <p class="text-4xl">👂</p>
                                <p class="text-lg font-bold text-slate-700">Sebutkan <span class="text-teal-600 underline decoration-2 underline-offset-4">3 suara</span> yang bisa kamu DENGAR.</p>
                            </div>
                        </template>
                        <template x-if="step === 4">
                            <div x-transition class="space-y-3">
                                <p class="text-4xl">👃</p>
                                <p class="text-lg font-bold text-slate-700">Sebutkan <span class="text-teal-600 underline decoration-2 underline-offset-4">2 aroma</span> yang bisa kamu CIUM.</p>
                            </div>
                        </template>
                        <template x-if="step === 5">
                            <div x-transition class="space-y-3">
                                <p class="text-4xl">👅</p>
                                <p class="text-lg font-bold text-slate-700">Sebutkan <span class="text-teal-600 underline decoration-2 underline-offset-4">1 rasa</span> yang bisa kamu RASAKAN.</p>
                            </div>
                        </template>
                    </div>

                    <div class="flex gap-3 mt-10">
                        <button @click="step > 1 ? step-- : step = 1" 
                                class="flex-1 py-4 bg-slate-50 text-slate-400 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-100 transition">
                            Sebelumnya
                        </button>
                        <button @click="step < 5 ? step++ : step = 1" 
                                class="flex-[2] py-4 bg-teal-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-700 shadow-lg shadow-teal-100 transition"
                                x-text="step === 5 ? 'Selesai & Ulangi' : 'Lanjut Langkah Berikutnya'">
                        </button>
                    </div>
                </div>

                {{-- Fast Tips --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-6 bg-white rounded-[2rem] border border-slate-100 group hover:border-teal-200 transition-colors">
                        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-4 text-2xl group-hover:scale-110 transition-transform">☁️</div>
                        <h3 class="font-black text-slate-900 mb-2">Power Nap</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Tidur singkat 20 menit bisa mengembalikan fokus otakmu secara instan.</p>
                    </div>
                    <div class="p-6 bg-white rounded-[2rem] border border-slate-100 group hover:border-teal-200 transition-colors">
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-4 text-2xl group-hover:scale-110 transition-transform">💧</div>
                        <h3 class="font-black text-slate-900 mb-2">Minum Air Putih</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">Otak yang terhidrasi bekerja 14% lebih cepat daripada otak yang haus.</p>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-teal-500/20 rounded-full blur-3xl"></div>
                    <h3 class="relative text-lg font-black mb-4 tracking-tight">Butuh teman bicara?</h3>
                    <p class="relative text-xs text-slate-400 leading-relaxed mb-8">Ujian memang berat, tapi kamu tidak harus melaluinya sendirian. Konsultasi gratis dengan Guru BK.</p>
                    <a href="{{ route('layanan.konseling') }}" class="relative block w-full py-4 bg-teal-600 text-white text-center rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-white hover:text-slate-900 transition-all">Mulai Konseling</a>
                </div>

                <div class="p-8 bg-white rounded-[2.5rem] border border-slate-100">
                    <h3 class="font-black text-slate-900 text-xs uppercase tracking-widest mb-4 opacity-50">Quotes</h3>
                    <p class="text-sm italic text-slate-600 leading-relaxed">"Ujian hanyalah kertas di atas meja. Hidupmu adalah petualangan besar di luar sana. Don't panic."</p>
                </div>
            </aside>

        </div>
    </div>
</div>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection