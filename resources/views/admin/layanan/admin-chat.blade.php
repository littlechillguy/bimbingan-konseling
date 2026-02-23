@extends('layouts.app')

@section('title', 'Pesan Anonim - Admin SMKN 43')
@section('page_title', 'Kotak Pesan Anonim')

@section('content')
<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden">
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        @include('admin.partials.navbar')

        <main class="p-6 lg:p-10">
            {{-- Alert Success --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-teal-50 border border-teal-100 rounded-2xl text-teal-700 text-xs font-bold animate-fade-in">
                    {{ session('success') }}
                </div>
            @endif

            <header class="mb-10">
                <h1 class="text-3xl font-black text-gray-900 leading-tight">Pesan Masuk</h1>
                <p class="text-gray-500 font-medium">Mendengarkan keresahan siswa secara anonim.</p>
            </header>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="xl:col-span-2 space-y-4">
                    @forelse($messages as $msg)
                    {{-- Card Pesan: Jika belum dibaca (is_read = false), tampilkan border teal --}}
                    <div class="bg-white border {{ $msg->is_read ? 'border-gray-100' : 'border-teal-200 ring-1 ring-teal-100' }} p-6 rounded-[2rem] shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden">
                        
                        @if(!$msg->is_read)
                            <div class="absolute top-0 right-0 px-4 py-1 bg-teal-500 text-[8px] font-black text-white uppercase tracking-widest rounded-bl-xl">Baru</div>
                        @endif

                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 {{ $msg->is_read ? 'bg-gray-100 text-gray-400' : 'bg-teal-50 text-teal-600' }} rounded-full flex items-center justify-center font-black text-xs">
                                    A
                                </div>
                                <div>
                                    <p class="text-sm font-black text-gray-900 leading-none">Siswa Anonim</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase mt-1 tracking-widest">
                                        {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-gray-900 text-white text-[9px] font-black rounded-full uppercase tracking-tighter">
                                Identity Masked
                            </span>
                        </div>
                        
                        <div class="{{ $msg->is_read ? 'bg-gray-50/30' : 'bg-teal-50/30' }} rounded-2xl p-5 border border-gray-50">
                            <p class="text-gray-700 leading-relaxed text-sm italic">
                                "{{ $msg->message }}"
                            </p>
                        </div>

                        <div class="mt-4 flex justify-end gap-2">
                            {{-- Tombol Tandai Dibaca (Hanya muncul jika is_read masih false) --}}
                            @if(!$msg->is_read)
                            <form action="{{ route('admin.chat.read', $msg->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-teal-600 hover:bg-teal-50 rounded-xl transition">
                                    Tandai Dibaca
                                </button>
                            </form>
                            @endif

                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.chat.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini selamanya?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-4 py-2 text-[10px] font-black uppercase tracking-widest text-red-500 hover:bg-red-50 rounded-xl transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white border-2 border-dashed border-gray-200 p-20 rounded-[3rem] text-center">
                        <p class="text-gray-400 font-bold tracking-tight">Belum ada pesan anonim yang masuk.</p>
                    </div>
                    @endforelse
                </div>

                <div class="space-y-6">
                    {{-- Ringkasan Status --}}
                    <div class="bg-white border border-gray-100 p-6 rounded-[2rem] shadow-sm">
                        <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-4">Statistik</h4>
                        <div class="flex justify-between items-center p-3 bg-teal-50 rounded-2xl mb-2">
                            <span class="text-[10px] font-bold text-teal-700 uppercase">Belum Dibaca</span>
                            <span class="text-lg font-black text-teal-800">{{ $messages->where('is_read', false)->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-2xl">
                            <span class="text-[10px] font-bold text-gray-500 uppercase">Total Pesan</span>
                            <span class="text-lg font-black text-gray-800">{{ count($messages) }}</span>
                        </div>
                    </div>

                    <div class="bg-teal-600 p-8 rounded-[2.5rem] text-white shadow-xl shadow-teal-100 relative overflow-hidden">
                        <h3 class="text-xl font-black mb-2">Informasi</h3>
                        <p class="text-teal-100 text-[11px] font-medium leading-relaxed italic">
                            "Menghapus pesan akan menghilangkannya secara permanen dari database."
                        </p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection