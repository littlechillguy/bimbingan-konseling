@extends('layouts.app')

@section('title', 'Admin Dashboard - SMKN 43 JAKARTA')
@section('page_title', 'Dashboard Overview')

@section('content')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden" x-data="{ openModal: false, activeMessage: '', activeName: '' }">
        
        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-y-auto">
            
            @include('admin.partials.navbar')

            <div class="flex flex-col xl:flex-row gap-0">
                <main class="flex-1 p-6 lg:p-10">
                    
                    <header class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="p-4 bg-teal-600 rounded-2xl text-white shadow-lg shadow-teal-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-black text-gray-900 leading-tight">Ringkasan Utama 👋</h1>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Panel Kendali Guru BK SMKN 43 Jakarta</p>
                            </div>
                        </div>
                    </header>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div class="p-8 bg-white border border-gray-100 rounded-[2.5rem] shadow-sm relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-24 h-24 bg-teal-50 rounded-full transition-transform group-hover:scale-150"></div>
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-[0.2em] mb-2 relative">Total Siswa Terdaftar</p>
                            <p class="text-4xl font-black text-gray-900 relative">{{ $totalSiswa ?? '0' }}</p>
                        </div>

                        <div class="p-8 bg-white border border-gray-100 rounded-[2.5rem] shadow-sm relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full transition-transform group-hover:scale-150"></div>
                            <p class="text-[10px] font-black text-orange-600 uppercase tracking-[0.2em] mb-2 relative">Antrean Pending</p>
                            <p class="text-4xl font-black text-orange-600 relative">{{ $requests->where('status', 'pending')->count() }}</p>
                        </div>
                    </div>

                    {{-- Main Table Section --}}
                    <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                            <div>
                                <h2 class="text-xl font-black text-gray-900 tracking-tight">Antrean Konseling Terbaru</h2>
                                <p class="text-[10px] text-gray-400 mt-1 font-bold uppercase tracking-widest">Daftar siswa yang masuk</p>
                            </div>
                            <a href="{{ route('admin.layanan.tindak-lanjut') }}" class="px-5 py-2.5 bg-gray-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-gray-800 transition">
                                Lihat Semua
                            </a>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50/50 text-gray-400 uppercase text-[10px] font-black tracking-[0.2em] border-b border-gray-100">
                                        <th class="px-8 py-5">Siswa</th>
                                        <th class="px-8 py-5">Masalah</th>
                                        <th class="px-8 py-5">Urgensi</th>
                                        <th class="px-8 py-5 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 font-medium">
                                    @forelse($requests as $item)
                                    <tr class="hover:bg-teal-50/10 transition group">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 font-black text-xs">
                                                    {{ substr($item->user->name, 0, 2) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-gray-900">{{ $item->user->name }}</p>
                                                    <p class="text-[10px] text-gray-400">WA: {{ $item->whatsapp }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="px-8 py-6 max-w-[300px]">
                                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-widest mb-1">{{ $item->category }}</p>
                                            <p class="text-xs text-gray-600 line-clamp-1 italic italic">
                                                "{{ $item->message }}"
                                            </p>
                                        </td>

                                        <td class="px-8 py-6">
                                            <span class="inline-flex px-3 py-1 rounded-lg text-[9px] font-black uppercase border
                                                {{ $item->urgency == 'darurat' ? 'bg-red-50 text-red-600 border-red-100' : ($item->urgency == 'sedang' ? 'bg-orange-50 text-orange-600 border-orange-100' : 'bg-blue-50 text-blue-600 border-blue-100') }}">
                                                {{ $item->urgency }}
                                            </span>
                                        </td>

                                        <td class="px-8 py-6 text-right">
                                            <div class="flex justify-end gap-2">
                                                <button 
                                                    @click="openModal = true; activeMessage = '{{ addslashes($item->message) }}'; activeName = '{{ $item->user->name }}'"
                                                    class="p-2 text-gray-400 hover:text-teal-600 transition-colors" title="Baca Pesan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                </button>
                                                {{-- Link ke halaman Tindak Lanjut --}}
                                                <a href="{{ route('admin.layanan.tindak-lanjut') }}" class="p-2 text-teal-600 hover:bg-teal-50 rounded-lg transition-colors" title="Proses Penjadwalan">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-8 py-20 text-center opacity-30 font-black uppercase tracking-[0.2em] text-xs">Kosong</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        {{-- MODAL DETAIL KELUHAN --}}
        <div x-show="openModal" class="fixed inset-0 z-[99] flex items-center justify-center p-6 bg-gray-900/60 backdrop-blur-sm" x-cloak style="display: none;">
            <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-lg w-full p-10 transform transition-all relative" @click.away="openModal = false">
                <h3 class="text-xl font-black text-gray-900 mb-1" x-text="activeName"></h3>
                <p class="text-[10px] text-teal-600 font-bold uppercase tracking-widest mb-6">Pesan Siswa</p>
                
                <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100">
                    <p class="text-gray-600 italic leading-relaxed text-sm" x-text="'&quot;' + activeMessage + '&quot;'"></p>
                </div>
                
                <div class="mt-8 flex gap-3">
                    <button @click="openModal = false" class="flex-1 py-4 bg-gray-100 text-gray-600 rounded-2xl font-black text-[10px] uppercase tracking-widest">Tutup</button>
                    <a href="{{ route('admin.layanan.tindak-lanjut') }}" class="flex-1 py-4 bg-teal-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest text-center shadow-lg shadow-teal-100">Proses Sekarang</a>
                </div>
            </div>
        </div>
    </div>
@endsection