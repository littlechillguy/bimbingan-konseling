@extends('layouts.app')

@section('title', 'Tindak Lanjut - SMKN 43 Jakarta')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] flex">
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex flex-col lg:flex-row gap-10">
                    
                    {{-- SISI KIRI: DAFTAR ANTREAN (UTAMA) --}}
                    <div class="flex-1">
                        <div class="mb-8">
                            <h2 class="text-2xl font-black text-slate-800 tracking-tight">Antrean Masuk</h2>
                            <p class="text-sm text-slate-400 font-medium">Klik centang untuk mengonfirmasi jadwal siswa.</p>
                        </div>

                        <div class="space-y-4">
                            @forelse($requests as $pending)
                            <div class="bg-white border border-slate-200 rounded-[2rem] p-6 shadow-sm">
                                <form action="{{ route('admin.counseling.update', $pending->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="space-y-5">
                                        {{-- Header Kartu --}}
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center font-black text-xs">
                                                    {{ substr($pending->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h4 class="text-sm font-black text-slate-800">{{ $pending->user->name }}</h4>
                                                    <p class="text-[10px] font-bold text-slate-400 uppercase">{{ $pending->category }}</p>
                                                </div>
                                            </div>
                                            <span class="text-[10px] font-medium text-slate-400">{{ $pending->created_at->diffForHumans() }}</span>
                                        </div>

                                        {{-- Pesan --}}
                                        <div class="text-xs text-slate-500 leading-relaxed italic px-2 border-l-2 border-slate-100">
                                            "{{ $pending->message }}"
                                        </div>

                                        {{-- Row Input --}}
                                        <div class="flex flex-wrap md:flex-nowrap items-center gap-2 pt-2">
                                            <select name="service_type" required class="flex-1 bg-slate-50 border-none rounded-xl text-[11px] font-bold py-2.5 focus:ring-2 focus:ring-teal-500">
                                                <option value="" disabled selected>Layanan</option>
                                                <option value="individu">Individu</option>
                                                <option value="kelompok">Kelompok</option>
                                                <option value="panggilan_ortu">Ortu</option>
                                            </select>
                                            <input type="date" name="scheduled_date" required class="flex-1 bg-slate-50 border-none rounded-xl text-[11px] font-bold py-2.5">
                                            <input type="time" name="scheduled_time" required class="w-24 bg-slate-50 border-none rounded-xl text-[11px] font-bold py-2.5">
                                            
                                            <button type="submit" class="bg-teal-600 text-white p-2.5 rounded-xl hover:bg-teal-700 transition-all shadow-md shadow-teal-100">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @empty
                            <div class="py-20 text-center border-2 border-dashed border-slate-200 rounded-[3rem]">
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada antrean</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- SISI KANAN: STATUS RINGKAS (SUPORTIF) --}}
                    <div class="lg:w-80 shrink-0">
                        <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8">
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-6">Status Hari Ini</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between text-[10px] font-black uppercase mb-2">
                                        <span class="text-slate-400">Beban Kerja</span>
                                        <span class="text-teal-600">{{ $requests->count() }} Antrean</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="bg-teal-500 h-full" style="width: {{ min($requests->count() * 10, 100) }}%"></div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-slate-50">
                                    <p class="text-[11px] text-slate-500 leading-relaxed">
                                        Pastikan untuk memeriksa **Jadwal Harian** sebelum menetapkan waktu agar tidak terjadi tabrakan sesi bimbingan.
                                    </p>
                                </div>

                                <a href="#" class="block w-full py-3 bg-slate-50 text-slate-600 text-center rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-100 transition">
                                    Lihat Semua Jadwal
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</div>
@endsection