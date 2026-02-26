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
                            <p class="text-sm text-slate-400 font-medium">Atur jadwal dan kirim konfirmasi otomatis ke WhatsApp siswa.</p>
                        </div>

                        <div class="space-y-4">
                            @forelse($requests as $pending)
                            <div class="bg-white border border-slate-200 rounded-[2rem] p-6 shadow-sm hover:shadow-md transition-all">
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
                                                    {{-- Menampilkan Kategori (Data 'Lainnya' akan otomatis muncul sebagai teks spesifik di sini) --}}
                                                    <div class="flex items-center gap-2">
                                                        <p class="text-[10px] font-bold text-teal-600 uppercase tracking-widest">{{ $pending->category }}</p>
                                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                                        <span class="text-[10px] font-bold text-slate-400 uppercase">{{ $pending->user->class ?? 'Siswa' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex flex-col items-end">
                                                <span class="text-[10px] font-medium text-slate-400">{{ $pending->created_at->diffForHumans() }}</span>
                                                {{-- Badge Urgensi --}}
                                                <span class="text-[8px] font-black uppercase px-2 py-0.5 rounded-full mt-1 {{ $pending->urgency == 'darurat' ? 'bg-red-100 text-red-600' : 'bg-slate-100 text-slate-500' }}">
                                                    {{ $pending->urgency }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Pesan & Tombol Chat Cepat --}}
                                        <div class="space-y-3">
                                            <div class="text-xs text-slate-500 leading-relaxed italic px-3 border-l-2 border-teal-100 bg-slate-50 py-2 rounded-r-lg">
                                                "{{ $pending->message }}"
                                            </div>
                                            
                                            {{-- Fitur WhatsApp Koordinasi --}}
                                            <a href="https://wa.me/{{ str_starts_with($pending->whatsapp, '0') ? '62'.substr($pending->whatsapp, 1) : $pending->whatsapp }}" 
                                               target="_blank" 
                                               class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-600 hover:text-emerald-700 transition-colors group">
                                                <svg class="w-3.5 h-3.5 transition-transform group-hover:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.937 3.672 1.433 5.66 1.434h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                                Tanya Detail ke Siswa
                                            </a>
                                        </div>

                                        {{-- Row Input Konfirmasi --}}
                                        <div class="flex flex-wrap md:flex-nowrap items-center gap-2 pt-2 border-t border-slate-50">
                                            <select name="service_type" required class="flex-1 bg-slate-50 border-none rounded-xl text-[11px] font-bold py-2.5 focus:ring-2 focus:ring-teal-500">
                                                <option value="" disabled selected>Layanan</option>
                                                <option value="individu">Individu</option>
                                                <option value="kelompok">Kelompok</option>
                                                <option value="panggilan_ortu">Ortu</option>
                                                <option value="reveral">Referal</option>
                                                <option value="mediasi">Mediasi</option>
                                            </select>
                                            <input type="date" name="scheduled_date" required class="flex-1 bg-slate-50 border-none rounded-xl text-[11px] font-bold py-2.5 focus:ring-2 focus:ring-teal-500">
                                            <input type="time" name="scheduled_time" required class="w-24 bg-slate-50 border-none rounded-xl text-[11px] font-bold py-2.5 focus:ring-2 focus:ring-teal-500">
                                            
                                            <button type="submit" class="bg-teal-600 text-white p-2.5 rounded-xl hover:bg-teal-700 transition-all shadow-md shadow-teal-100 flex items-center justify-center group">
                                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @empty
                            <div class="py-20 text-center border-2 border-dashed border-slate-200 rounded-[3rem]">
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada antrean baru</p>
                            </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- SISI KANAN: STATUS RINGKAS --}}
                    <div class="lg:w-80 shrink-0">
                        <div class="bg-white border border-slate-200 rounded-[2.5rem] p-8 sticky top-8">
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest mb-6">Status Hari Ini</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <div class="flex justify-between text-[10px] font-black uppercase mb-2">
                                        <span class="text-slate-400">Beban Kerja</span>
                                        <span class="text-teal-600">{{ $requests->count() }} Antrean</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="bg-teal-500 h-full transition-all duration-700" style="width: {{ min($requests->count() * 10, 100) }}%"></div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-slate-50">
                                    <p class="text-[11px] text-slate-500 leading-relaxed italic">
                                        "Klik tombol centang untuk menjadwalkan. Siswa akan menerima pesan otomatis berisi tautan WhatsApp Anda."
                                    </p>
                                </div>

                                {{-- Route Riwayat Diperbarui menjadi admin.hasil-konseling --}}
                                <a href="{{ route('admin.hasil-konseling') }}" class="group block w-full py-4 bg-slate-900 text-white text-center rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-teal-600 transition-all duration-300 shadow-xl shadow-slate-200 flex items-center justify-center gap-2">
                                    <span>Lihat Hasil Konseling</span>
                                    <svg class="w-3 h-3 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
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