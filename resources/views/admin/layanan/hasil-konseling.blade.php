@extends('layouts.app')

@section('title', 'Hasil Konseling - SMKN 43 JAKARTA')
@section('page_title', 'Layanan BK / Hasil Konseling')

@section('content')
<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden">
    
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <main class="flex-1 overflow-y-auto p-6 lg:p-10">
            <div class="max-w-5xl mx-auto w-full">
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-teal-50 text-teal-600 border border-teal-100 rounded-2xl font-bold flex items-center gap-3">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm p-8 mb-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Catat Hasil Konseling</h3>
                            <p class="text-sm text-gray-500 font-medium">Buat ringkasan dari sesi bimbingan yang telah dilakukan.</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.hasil-konseling.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Siswa</label>
                                <input type="text" name="nama_siswa" required placeholder="Masukkan nama siswa..." 
                                    class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition shadow-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Jenis Layanan</label>
                                <select name="jenis_layanan" required class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition shadow-sm appearance-none">
                                    <option value="Konseling Pribadi">Konseling Pribadi</option>
                                    <option value="Bimbingan Karir">Bimbingan Karir</option>
                                    <option value="Konseling Belajar">Konseling Belajar</option>
                                    <option value="Konseling Sosial">Konseling Sosial</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Keterangan / Hasil Akhir</label>
                            <textarea name="keterangan" rows="5" required placeholder="Tuliskan poin-poin hasil konseling atau rekomendasi di sini..." 
                                class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition shadow-sm"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-10 py-4 bg-teal-600 text-white font-black rounded-2xl hover:bg-teal-700 hover:shadow-xl hover:shadow-teal-100 transition-all duration-300">
                                Simpan Hasil Konseling
                            </button>
                        </div>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    @forelse($results as $res)
                        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-lg text-[10px] font-black uppercase tracking-tighter italic">
                                    {{ $res->jenis_layanan }}
                                </span>
                                <span class="text-[10px] text-gray-400 font-bold">
                                    {{ \Carbon\Carbon::parse($res->created_at)->format('d M Y') }}
                                </span>
                            </div>
                            <h4 class="font-bold text-gray-900 mb-2">{{ $res->nama_siswa }}</h4>
                            <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 italic">"{{ $res->keterangan }}"</p>
                        </div>
                    @empty
                        <div class="md:col-span-2 text-center py-10 bg-gray-50 rounded-[2rem] border border-dashed border-gray-200">
                            <p class="text-gray-400 font-medium text-sm">Belum ada catatan hasil konseling.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</div>
@endsection