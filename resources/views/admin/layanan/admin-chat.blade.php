@extends('layouts.app')

@section('title', 'Pesan Anonim - SMKN 43 JAKARTA')
@section('page_title', 'Kotak Pesan Anonim')

@section('content')
<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden">
    {{-- Sidebar Utama (Kiri) --}}
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <div class="flex-1 flex overflow-hidden">
            {{-- Main Content (Tengah) --}}
            <main class="flex-1 overflow-y-auto p-6 lg:p-10">
                <div class="max-w-4xl mx-auto w-full">
                    
                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-teal-50 border border-teal-100 rounded-2xl text-teal-700 text-xs font-bold animate-fade-in flex items-center gap-3">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Header dengan Ikon --}}
                    <header class="mb-10 flex items-center gap-4">
                        <div class="p-4 bg-teal-600 rounded-2xl text-white shadow-lg shadow-teal-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-black text-gray-900 leading-tight tracking-tight">Pesan Masuk</h1>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Kotak Aspirasi & Keluhan Siswa</p>
                        </div>
                    </header>

                    <div class="space-y-4">
                        @forelse($messages as $msg)
                        {{-- Card Pesan --}}
                        <div class="bg-white border {{ $msg->is_read ? 'border-gray-100' : 'border-teal-200 ring-1 ring-teal-50' }} p-6 rounded-[2.5rem] shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group">
                            
                            @if(!$msg->is_read)
                                <div class="absolute top-0 right-0 px-5 py-1.5 bg-teal-500 text-[8px] font-black text-white uppercase tracking-widest rounded-bl-2xl">Baru</div>
                            @endif

                            <div class="flex justify-between items-start mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 {{ $msg->is_read ? 'bg-gray-100 text-gray-400' : 'bg-teal-50 text-teal-600' }} rounded-xl flex items-center justify-center font-black text-xs shadow-sm">
                                        A
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-gray-900 leading-none">Siswa Anonim</p>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase mt-1.5 tracking-widest">
                                            {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-gray-900 text-white text-[9px] font-black rounded-full uppercase tracking-tighter opacity-80">
                                    Identity Masked
                                </span>
                            </div>
                            
                            <div class="{{ $msg->is_read ? 'bg-gray-50/50 border-gray-100' : 'bg-teal-50/30 border-teal-50' }} rounded-[1.5rem] p-6 border italic">
                                <p class="text-gray-700 leading-relaxed text-sm">
                                    "{{ $msg->message }}"
                                </p>
                            </div>

                            <div class="mt-4 flex justify-end items-center gap-2">
                                @if(!$msg->is_read)
                                <form action="{{ route('admin.chat.read', $msg->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="px-5 py-2 text-[10px] font-black uppercase tracking-widest text-teal-600 hover:bg-teal-50 rounded-xl transition-all border border-transparent hover:border-teal-100">
                                        Tandai Dibaca
                                    </button>
                                </form>
                                @endif

                                <form action="{{ route('admin.chat.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini selamanya?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 text-gray-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="bg-white border-2 border-dashed border-gray-100 p-20 rounded-[3rem] text-center">
                            <div class="w-16 h-16 bg-gray-50 text-gray-300 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <p class="text-gray-400 font-bold tracking-tight">Kotak pesan masih kosong.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </main>

            {{-- Sidebar Status (Kanan) --}}
            <aside class="w-80 bg-white border-l border-gray-100 p-8 hidden xl:flex flex-col">
                <div class="mb-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Ringkasan Kotak</h3>
                    
                    <div class="space-y-4">
                        <div class="bg-teal-600 p-6 rounded-[2rem] text-white shadow-xl shadow-teal-100">
                            <p class="text-teal-100 text-[10px] font-black uppercase tracking-widest mb-1">Belum Dibaca</p>
                            <h4 class="text-4xl font-black">{{ $messages->where('is_read', false)->count() }}</h4>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-[2rem] border border-gray-100">
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-2">Total Masuk</p>
                            <h4 class="text-xl font-black text-gray-800">{{ count($messages) }}</h4>
                        </div>
                    </div>
                </div>

                <div class="mt-auto p-6 bg-teal-50 rounded-3xl border border-teal-100">
                    <div class="w-8 h-8 bg-teal-200 text-teal-700 rounded-lg flex items-center justify-center text-sm mb-4">💬</div>
                    <p class="text-[11px] text-teal-800 font-bold leading-relaxed">
                        Pesan ini bersifat satu arah. Identitas siswa sepenuhnya disembunyikan oleh sistem untuk menjaga privasi.
                    </p>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection