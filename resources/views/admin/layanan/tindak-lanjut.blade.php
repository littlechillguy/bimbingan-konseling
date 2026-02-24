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
                            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Manajemen Tindak Lanjut</h2>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Proses Antrean & Pantau Jadwal</p>
                        </div>
                    </div>
                </header>

                {{-- SECTION 1: ANTREAN BARU --}}
                <section class="mb-12">
                    <div class="flex items-center gap-2 mb-6">
                        <span class="w-2 h-6 bg-teal-500 rounded-full"></span>
                        <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Butuh Tindak Lanjut Segera</h3>
                    </div>

                    <div class="space-y-4">
                        @forelse($requests as $pending)
                        <div class="bg-white border border-gray-100 rounded-[2.5rem] p-6 lg:p-8 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex flex-col lg:flex-row gap-8">
                                
                                {{-- Kiri: Info Siswa --}}
                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-teal-100">Antrean Baru</span>
                                            <h4 class="text-lg font-black text-gray-900 mt-2 capitalize">{{ $pending->user->name }}</h4>
                                        </div>
                                        <button @click="openModal = true; activeMessage = '{{ addslashes($pending->message) }}'; activeName = '{{ $pending->user->name }}'; activeCategory = '{{ $pending->category }}'" 
                                                class="flex items-center gap-2 text-[10px] font-black text-teal-600 uppercase tracking-widest hover:text-teal-700">
                                            <span>Lihat Keluhan</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                        </button>
                                    </div>
                                    <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                                        <p class="text-xs text-gray-500 font-medium italic line-clamp-2">"{{ $pending->message }}"</p>
                                    </div>
                                </div>

                                {{-- Kanan: Form Aksi --}}
                                <div class="lg:w-2/3">
                                    <form action="{{ route('admin.counseling.update', $pending->id) }}" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @csrf
                                        <div>
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Jenis Layanan</label>
                                            <select name="type_service" required class="w-full mt-1 bg-gray-50 border-none rounded-xl text-xs font-bold py-3.5 focus:ring-2 focus:ring-teal-500">
                                                <option value="" disabled selected>Pilih Layanan</option>
                                                <option value="individu">Konseling Individu</option>
                                                <option value="kelompok">Bimbingan Kelompok</option>
                                                <option value="panggilan_ortu">Panggilan Ortu</option>
                                                <option value="mediasi">Mediasi</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Tentukan Tanggal</label>
                                            <input type="date" name="date" required class="w-full mt-1 bg-gray-50 border-none rounded-xl text-xs font-bold py-3.5 focus:ring-2 focus:ring-teal-500">
                                        </div>
                                        <div class="relative">
                                            <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Jam (24H)</label>
                                            <div class="flex gap-2">
                                                <input type="time" name="time" required class="flex-1 mt-1 bg-gray-50 border-none rounded-xl text-xs font-bold py-3.5 focus:ring-2 focus:ring-teal-500">
                                                <button type="submit" class="mt-1 bg-teal-600 text-white px-5 rounded-xl hover:bg-teal-700 transition shadow-lg shadow-teal-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="py-12 text-center bg-white rounded-[3rem] border border-dashed border-gray-200">
                            <div class="bg-gray-50 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Semua antrean baru sudah diproses</p>
                        </div>
                        @endforelse
                    </div>
                </section>

                {{-- SECTION 2: JADWAL BERJALAN --}}
                <section>
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-6 bg-orange-500 rounded-full"></span>
                            <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest">Monitoring Jadwal Aktif</h3>
                        </div>
                        <span class="text-[10px] font-black text-orange-600 bg-orange-50 px-4 py-1.5 rounded-full border border-orange-100 uppercase tracking-widest">{{ $scheduledRequests->count() }} Sesi Berjalan</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @forelse($scheduledRequests as $data)
                        <div class="bg-white border border-gray-100 rounded-[2.5rem] p-8 shadow-sm group hover:border-teal-200 transition-all duration-300">
                            <div class="flex justify-between items-start mb-6">
                                <div class="p-3 bg-gray-50 rounded-2xl">
                                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-[8px] font-black uppercase tracking-widest border border-orange-100">Scheduled</span>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-black text-gray-900 mb-1 capitalize">{{ $data->user->name }}</h3>
                                <p class="text-[10px] text-teal-600 font-black uppercase tracking-widest">
                                    {{ $data->service_type ? str_replace('_', ' ', $data->service_type) : 'Konseling' }}
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-3 mb-8">
                                <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                                    <p class="text-[8px] font-black text-gray-400 uppercase mb-1">Tanggal</p>
                                    <p class="text-[11px] font-bold text-gray-700">{{ date('d M Y', strtotime($data->scheduled_date)) }}</p>
                                </div>
                                <div class="p-3 bg-gray-50 rounded-2xl border border-gray-100">
                                    <p class="text-[8px] font-black text-gray-400 uppercase mb-1">Waktu</p>
                                    <p class="text-[11px] font-bold text-gray-700">{{ date('H:i', strtotime($data->scheduled_time)) }} WIB</p>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <form action="{{ route('admin.counseling.complete', $data->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full bg-emerald-500 text-white font-black py-3.5 rounded-xl hover:bg-emerald-600 transition text-[9px] uppercase tracking-widest shadow-lg shadow-emerald-50">Selesai</button>
                                </form>
                                <button @click="openModal = true; activeMessage = '{{ addslashes($data->message) }}'; activeName = '{{ $data->user->name }}'; activeCategory = '{{ $data->category }}'" 
                                        class="px-5 py-3.5 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <form action="{{ route('admin.counseling.delete', $data->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Batalkan & Hapus jadwal ini?')" class="p-3.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-16 bg-white border border-dashed border-gray-200 rounded-[3rem] text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Belum ada jadwal pertemuan yang dibuat</p>
                        </div>
                        @endforelse
                    </div>
                </section>
            </div>
        </main>
    </div>

    {{-- MODAL DETAIL --}}
    <div x-show="openModal" class="fixed inset-0 z-[99] flex items-center justify-center p-6 bg-gray-900/60 backdrop-blur-sm" x-cloak style="display: none;" x-transition>
        <div class="bg-white rounded-[3rem] shadow-2xl max-w-lg w-full p-10 relative overflow-hidden" @click.away="openModal = false">
            <div class="absolute top-0 right-0 p-8">
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-900 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="mb-8">
                <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-teal-100">Detail Laporan</span>
                <h3 class="text-2xl font-black text-gray-900 mt-3 capitalize" x-text="activeName"></h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1" x-text="'Kategori: ' + activeCategory"></p>
            </div>

            <div class="bg-gray-50 p-8 rounded-[2rem] border border-gray-100 mb-8">
                <p class="text-gray-600 italic leading-relaxed text-sm whitespace-pre-line" x-text="'&quot;' + activeMessage + '&quot;'"></p>
            </div>

            <button @click="openModal = false" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-black transition shadow-xl shadow-gray-200">
                Pahami & Tutup
            </button>
        </div>
    </div>
</div>

<style> 
    [x-cloak] { display: none !important; } 
    /* Menghilangkan AM/PM pada beberapa browser jika memungkinkan */
    input[type="time"]::-webkit-calendar-picker-indicator {
        filter: invert(48%) sepia(13%) saturate(3207%) hue-rotate(130deg) brightness(95%) contrast(80%);
    }
</style>
@endsection