@extends('layouts.app')

@section('title', 'Monitoring Jadwal - SMKN 43 Jakarta')

@section('content')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen bg-[#F4F7FE] flex"
    x-data="{ 
        openModal: false, 
        activeMessage: '', 
        activeName: '', 
        showToast: {{ session('success') ? 'true' : 'false' }},
        toastMessage: '{{ session('success') }}',
        confirmOpen: false,
        confirmTitle: '',
        confirmText: '',
        confirmAction: null,
        confirmColor: 'teal',
        showHistory: false
     }"
    x-init="if(showToast) setTimeout(() => showToast = false, 3000)">

    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        @include('admin.partials.navbar')

        <main class="p-6 lg:p-10 relative">

            {{-- TOAST NOTIFICATION --}}
            <template x-if="showToast">
                <div x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-y-4"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    class="fixed bottom-10 right-10 z-[110] bg-gray-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4 border border-gray-700">
                    <div class="p-2 bg-teal-500 rounded-lg">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <span class="text-[11px] font-black uppercase tracking-widest" x-text="toastMessage"></span>
                </div>
            </template>

            <div class="max-w-6xl mx-auto">
                {{-- Header Section --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                    <div>
                        <nav class="flex items-center gap-2 text-[10px] font-black text-teal-600 uppercase tracking-[0.2em] mb-2">
                            <span>Layanan BK</span>
                            <svg class="w-2 h-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"></path>
                            </svg>
                            <span class="text-gray-400">Jadwal Aktif</span>
                        </nav>
                        <h2 class="text-3xl font-black text-gray-900 tracking-tight">Monitoring Sesi <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-500 to-emerald-500">Konseling</span></h2>
                    </div>

                    <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-gray-100">
                        <div class="flex -space-x-2 overflow-hidden px-2">
                            @foreach($scheduledRequests->take(3) as $s)
                            <div class="inline-block h-8 w-8 rounded-full ring-2 ring-white bg-teal-100 flex items-center justify-center text-[10px] font-bold text-teal-600 border border-teal-200">
                                {{ substr($s->user->name, 0, 1) }}
                            </div>
                            @endforeach
                        </div>
                        <div class="pr-4 border-l border-gray-100 pl-4 text-center">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none">Total Antrean</p>
                            <p class="text-lg font-black text-teal-600">{{ $scheduledRequests->count() }}</p>
                        </div>
                    </div>
                </div>

                {{-- List Jadwal Aktif --}}
                <div class="grid gap-4">
                    @forelse($scheduledRequests as $data)
                    <div class="group relative bg-white border border-transparent hover:border-teal-200 rounded-[2rem] p-5 transition-all duration-300 hover:shadow-[0_20px_50px_rgba(20,184,166,0.05)]">
                        <div class="flex flex-col lg:flex-row lg:items-center gap-6">

                            {{-- Date Badge --}}
                            <div class="flex lg:flex-col items-center justify-center bg-gray-50 group-hover:bg-teal-50 rounded-[1.5rem] py-3 px-5 lg:w-24 transition-colors duration-300">
                                <span class="text-[10px] font-black text-gray-400 group-hover:text-teal-400 uppercase">{{ date('M', strtotime($data->scheduled_date)) }}</span>
                                <span class="text-2xl font-black text-gray-900 group-hover:text-teal-600 leading-none my-1">{{ date('d', strtotime($data->scheduled_date)) }}</span>
                                <span class="text-[10px] font-bold text-gray-500">{{ date('H:i', strtotime($data->scheduled_time)) }}</span>
                            </div>

                            {{-- Student Info --}}
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="text-xl font-black text-gray-900 capitalize">{{ $data->user->name }}</h3>
                                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100">
                                        {{ $data->service_type ? str_replace('_', ' ', $data->service_type) : 'Konseling' }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-4 text-gray-400">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest text-[9px]">Ruang Konseling BK</span>
                                    </div>
                                    <button @click="openModal = true; activeMessage = '{{ addslashes($data->message) }}'; activeName = '{{ $data->user->name }}'"
                                        class="text-[9px] font-black text-teal-600 uppercase tracking-widest hover:underline decoration-2 underline-offset-4">
                                        Lihat Pesan Siswa
                                    </button>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-3 lg:ml-auto">
                                <button type="button"
                                    @click="confirmOpen = true; 
                                            confirmTitle = 'Selesaikan Sesi?'; 
                                            confirmText = 'Apakah Anda yakin ingin menandai sesi konseling {{ $data->user->name }} sebagai selesai?'; 
                                            confirmColor = 'teal';
                                            confirmAction = () => { $refs['complete-form-{{ $data->id }}'].submit() }"
                                    class="bg-gray-900 hover:bg-teal-600 text-white font-black text-[10px] uppercase tracking-[0.15em] px-8 py-4 rounded-2xl transition-all duration-300 shadow-xl shadow-gray-200 hover:shadow-teal-200 active:scale-95">
                                    Selesaikan Sesi
                                </button>
                                <form x-ref="complete-form-{{ $data->id }}" action="{{ route('admin.counseling.complete', $data->id) }}" method="POST" class="hidden">
                                    @csrf
                                </form>

                                <button type="button"
                                    @click="confirmOpen = true; 
                                            confirmTitle = 'Batalkan Jadwal?'; 
                                            confirmText = 'Data ini akan dihapus permanen.'; 
                                            confirmColor = 'red';
                                            confirmAction = () => { $refs['delete-form-{{ $data->id }}'].submit() }"
                                    class="p-4 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-2xl transition-all duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                                <form x-ref="delete-form-{{ $data->id }}" action="{{ route('admin.counseling.delete', $data->id) }}" method="POST" class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-32 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center">
                        <div class="p-6 bg-gray-50 rounded-full mb-4">
                            <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-gray-400 font-black text-xs uppercase tracking-[0.2em]">Belum Ada Agenda Hari Ini</h4>
                    </div>
                    @endforelse
                </div>

                {{-- SECTION RIWAYAT (COLLAPSIBLE) --}}
                <div class="mt-16 mb-10">
                    <div class="flex items-center gap-4 mb-6 group cursor-pointer" @click="showHistory = !showHistory">
                        <div class="h-[1px] flex-1 bg-gray-200 group-hover:bg-teal-200 transition-colors"></div>
                        <button class="flex items-center gap-3 px-6 py-2 bg-white border border-gray-100 rounded-full shadow-sm group-hover:border-teal-200 transition-all">
                            <span class="text-[10px] font-black text-gray-400 group-hover:text-teal-600 uppercase tracking-[0.2em]">Riwayat Selesai</span>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-teal-600 transition-transform duration-500" 
                                 :class="showHistory ? 'rotate-180' : ''" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="h-[1px] flex-1 bg-gray-200 group-hover:bg-teal-200 transition-colors"></div>
                    </div>

                    <div x-show="showHistory" 
                         x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-4"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($completedRequests as $history)
                        <div class="bg-white/50 border border-gray-100 rounded-[1.5rem] p-4 hover:bg-white hover:shadow-md transition-all duration-300 group/card">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-teal-50 rounded-full flex items-center justify-center text-teal-600 group-hover/card:bg-teal-500 group-hover/card:text-white transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-[11px] font-black text-gray-900 capitalize leading-none mb-1">{{ Str::limit($history->user->name, 20) }}</h4>
                                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">{{ date('d M Y', strtotime($history->scheduled_date)) }}</p>
                                    </div>
                                </div>
                                <button @click="openModal = true; activeMessage = '{{ addslashes($history->message) }}'; activeName = '{{ $history->user->name }}'"
                                    class="p-1.5 bg-gray-50 text-gray-400 hover:text-teal-500 hover:bg-teal-50 rounded-lg transition-colors" title="Lihat Pesan Siswa">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex justify-end">
                                <a href="{{ route('admin.hasil-konseling') }}" class="text-[8px] font-black text-teal-600 uppercase tracking-widest hover:underline">Lihat Detail Arsip</a>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full py-10 text-center bg-white/30 rounded-[2rem] border-2 border-dashed border-gray-100">
                            <p class="text-[10px] font-bold text-gray-300 uppercase tracking-widest">Belum ada riwayat</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL KONFIRMASI KUSTOM --}}
    <div x-show="confirmOpen" class="fixed inset-0 z-[150] flex items-center justify-center p-6 bg-gray-900/40 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-sm w-full p-8 relative border border-gray-100 text-center" @click.away="confirmOpen = false">
            <div :class="confirmColor === 'red' ? 'bg-red-50 text-red-500' : 'bg-teal-50 text-teal-500'" class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <template x-if="confirmColor === 'teal'">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </template>
                <template x-if="confirmColor === 'red'">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                </template>
            </div>
            <h3 class="text-2xl font-black text-gray-900 mb-2" x-text="confirmTitle"></h3>
            <p class="text-gray-500 text-sm mb-8 px-4" x-text="confirmText"></p>
            <div class="flex gap-3">
                <button @click="confirmOpen = false" class="flex-1 py-4 bg-gray-50 text-gray-400 rounded-2xl font-black text-[10px] uppercase">Batal</button>
                <button @click="confirmAction(); confirmOpen = false" :class="confirmColor === 'red' ? 'bg-red-500' : 'bg-teal-600'" class="flex-1 py-4 text-white rounded-2xl font-black text-[10px] uppercase shadow-lg shadow-teal-100">Lanjutkan</button>
            </div>
        </div>
    </div>

    {{-- MODAL PESAN SISWA --}}
    <div x-show="openModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-gray-900/20 backdrop-blur-md" x-cloak x-transition>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-md w-full p-10 relative border border-gray-100" @click.away="openModal = false">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-2 h-8 bg-teal-500 rounded-full"></div>
                <h3 class="text-xl font-black text-gray-900 capitalize" x-text="activeName"></h3>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Pesan/Keluhan:</p>
            <div class="bg-teal-50/50 p-6 rounded-2xl mb-8 border border-teal-100">
                <p class="text-gray-700 italic text-sm leading-relaxed" x-text="'&quot;' + activeMessage + '&quot;'"></p>
            </div>
            <button @click="openModal = false" class="w-full py-4 bg-gray-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-600 transition-colors shadow-lg">Tutup</button>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    body { font-family: 'Inter', sans-serif; }
    /* Custom Scrollbar untuk sinkronisasi warna */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { bg: #f1f1f1; }
    ::-webkit-scrollbar-thumb { background: #14b8a6; border-radius: 10px; }
</style>
@endsection