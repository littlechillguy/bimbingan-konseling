@extends('layouts.app')

@section('title', 'Minat & Karir Siswa - Tenang.id')
@section('page_title', 'Layanan BK / Minat & Karir')

@section('content')
<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden">
    
    {{-- Include Sidebar --}}
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        {{-- Include Navbar --}}
        @include('admin.partials.navbar')

        {{-- Scrollable Content --}}
        <main class="flex-1 overflow-y-auto p-6 lg:p-10">
            <div class="max-w-6xl mx-auto w-full">
                
                <div class="flex items-center gap-4 mb-8">
                    <div class="p-4 bg-blue-600 rounded-2xl text-white shadow-lg shadow-blue-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-black text-gray-900">Hasil Eksplorasi Karir</h2>
                        <p class="text-sm text-gray-500 font-medium">Pantau minat, hobi, dan gaya kerja siswa secara real-time.</p>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <th class="px-8 py-5">Siswa</th>
                                <th class="px-8 py-5">Minat & Hobi</th>
                                <th class="px-8 py-5 text-center">Gaya Kerja</th>
                                <th class="px-8 py-5 text-right">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($dataKarir as $item)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&background=EBF4FF&color=3B82F6" class="w-10 h-10 rounded-xl" alt="Avatar">
                                        <div>
                                            <div class="font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $item->user->name }}</div>
                                            <div class="text-[10px] text-gray-400 font-medium uppercase tracking-tight">{{ $item->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="text-sm font-bold text-gray-700 mb-1">{{ $item->pelajaran_favorit }}</div>
                                    <div class="text-xs text-gray-500 leading-relaxed">{{ $item->hobi }}</div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-xl text-[10px] font-black uppercase tracking-wider">
                                        {{ $item->work_style }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <span class="text-xs font-bold text-gray-400">
                                        {{ $item->created_at->diffForHumans() }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-gray-50 text-gray-300 rounded-2xl flex items-center justify-center mb-4">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                        </div>
                                        <p class="text-gray-400 font-bold">Belum ada data eksplorasi masuk.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Dashboard Insight Mini --}}
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-600 p-6 rounded-[2rem] text-white">
                        <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-2">Total Partisipasi</p>
                        <h4 class="text-3xl font-black">{{ $dataKarir->count() }} <span class="text-sm font-normal opacity-60 italic text-blue-100">Siswa</span></h4>
                    </div>
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm md:col-span-2">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-lg">💡</div>
                            <p class="text-xs text-gray-500 font-medium leading-relaxed">Gunakan data ini untuk memberikan rekomendasi jurusan atau karir yang lebih personal saat sesi konseling tatap muka.</p>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
@endsection