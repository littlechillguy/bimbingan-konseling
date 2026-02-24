@extends('layouts.app')

@section('title', 'Tindak Lanjut - SMKN 43 Jakarta')

@section('content')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen bg-[#FBFBFB] flex" x-data="{ openModal: false, activeMessage: '', activeName: '', activeCategory: '' }">
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        @include('admin.partials.navbar')

        <main class="p-6 lg:p-10">
            <div class="max-w-7xl mx-auto w-full">
                
                {{-- Header --}}
                <header class="flex items-center justify-between mb-10">
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-teal-600 rounded-2xl text-white shadow-lg shadow-teal-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Antrean Masuk</h2>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Proses Permohonan Konseling Siswa</p>
                        </div>
                    </div>
                </header>

                {{-- SECTION: ANTREAN BARU --}}
                <section>
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2 h-6 bg-teal-500 rounded-full"></span>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Butuh Tindak Lanjut Segera</h3>
                    </div>

                    <div class="space-y-4">
                        @forelse($requests as $pending)
                        <div class="bg-white border border-gray-100 rounded-[2.5rem] p-6 lg:p-8 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex flex-col lg:flex-row gap-8 items-center">
                                
                                {{-- Kiri: Info Siswa --}}
                                <div class="w-full lg:w-1/3">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-teal-100">Antrean Baru</span>
                                            <h4 class="text-lg font-black text-gray-900 mt-2 capitalize">{{ $pending->user->name }}</h4>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100 relative group cursor-pointer" 
                                         @click="openModal = true; activeMessage = '{{ addslashes($pending->message) }}'; activeName = '{{ $pending->user->name }}'; activeCategory = '{{ $pending->category }}'">
                                        <p class="text-xs text-gray-500 font-medium italic line-clamp-2">"{{ $pending->message }}"</p>
                                        <div class="absolute inset-0 bg-teal-600/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center">
                                            <span class="text-[9px] font-black text-teal-700 uppercase">Klik Detail</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kanan: Form Penjadwalan --}}
                                <div class="w-full lg:w-2/3">
                                    <form action="{{ route('admin.counseling.update', $pending->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @csrf
                                        <div>
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Layanan</label>
                                            <select name="type_service" required class="w-full mt-1 bg-gray-50 border-none rounded-xl text-xs font-bold py-3.5 focus:ring-2 focus:ring-teal-500">
                                                <option value="" disabled selected>Pilih Jenis</option>
                                                <option value="individu">Konseling Individu</option>
                                                <option value="kelompok">Bimbingan Kelompok</option>
                                                <option value="panggilan_ortu">Panggilan Ortu</option>
                                                <option value="mediasi">Mediasi</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal</label>
                                            <input type="date" name="date" required class="w-full mt-1 bg-gray-50 border-none rounded-xl text-xs font-bold py-3.5 focus:ring-2 focus:ring-teal-500">
                                        </div>
                                        <div class="flex gap-2 items-end">
                                            <div class="flex-1">
                                                <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Waktu</label>
                                                <input type="time" name="time" required class="w-full mt-1 bg-gray-50 border-none rounded-xl text-xs font-bold py-3.5 focus:ring-2 focus:ring-teal-500">
                                            </div>
                                            <button type="submit" class="bg-teal-600 text-white p-3.5 rounded-xl hover:bg-teal-700 transition shadow-lg shadow-teal-100 group">
                                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="py-20 text-center bg-white rounded-[3rem] border border-dashed border-gray-200">
                            <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tidak ada antrean tertunda</p>
                        </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </main>
    </div>

    {{-- MODAL DETAIL --}}
    <div x-show="openModal" class="fixed inset-0 z-[99] flex items-center justify-center p-6 bg-gray-900/60 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white rounded-[3rem] shadow-2xl max-w-lg w-full p-10 relative" @click.away="openModal = false">
            <div class="absolute top-0 right-0 p-8">
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-900 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="mb-8">
                <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-teal-100">Detail Masalah</span>
                <h3 class="text-2xl font-black text-gray-900 mt-3 capitalize" x-text="activeName"></h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="'Kategori: ' + activeCategory"></p>
            </div>

            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 mb-8">
                <p class="text-gray-600 italic leading-relaxed text-sm whitespace-pre-line" x-text="'&quot;' + activeMessage + '&quot;'"></p>
            </div>

            <button @click="openModal = false" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-black transition">
                Tutup Detail
            </button>
        </div>
    </div>
</div>

<style> 
    [x-cloak] { display: none !important; } 
    input[type="date"]::-webkit-calendar-picker-indicator,
    input[type="time"]::-webkit-calendar-picker-indicator {
        cursor: pointer;
        filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%);
    }
</style>
@endsection