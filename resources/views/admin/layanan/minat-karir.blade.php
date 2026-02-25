@extends('layouts.app')

@section('title', 'Minat & Karir Siswa - SMKN 43 JAKARTA')
@section('page_title', 'Layanan BK / Minat & Karir')

@section('content')
{{-- Library Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden" x-data="{ openModal: false, modalData: {} }">
    
    {{-- Sidebar Utama (Kiri) --}}
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <div class="flex-1 flex overflow-hidden">
            {{-- Main Content (Tengah) --}}
            <main class="flex-1 overflow-y-auto p-6 lg:p-8">
                <div class="max-w-6xl mx-auto w-full">
                    
                    {{-- Alert Success --}}
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-teal-50 border border-teal-100 text-teal-600 rounded-2xl font-bold text-sm flex items-center gap-3 animate-fade-in">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-4 bg-teal-600 rounded-2xl text-white shadow-lg shadow-teal-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Hasil Eksplorasi Karir</h2>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Pantau Rencana BMW Siswa</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100">
                                    <th class="px-8 py-5">Siswa</th>
                                    <th class="px-6 py-5">Gaya Kerja</th>
                                    <th class="px-6 py-5">Rencana (BMW)</th>
                                    <th class="px-6 py-5">Minat & Hobi</th>
                                    <th class="px-6 py-5">Cita-cita & Keluhan</th>
                                    <th class="px-8 py-5 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($dataKarir as $item)
                                <tr class="hover:bg-teal-50/20 transition-colors group">
                                    <td class="px-8 py-6 align-top">
                                        <div class="flex items-center gap-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&background=F0FDFA&color=0D9488" class="w-10 h-10 rounded-xl" alt="Avatar">
                                            <div class="font-bold text-gray-900 group-hover:text-teal-600 transition truncate max-w-[120px]">
                                                {{ $item->user->name }}
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-6 align-top">
                                        @php
                                            $style = strtolower($item->work_style);
                                            $styleColor = match(true) {
                                                str_contains($style, 'tim') => 'bg-teal-50 text-teal-600 border-teal-100',
                                                str_contains($style, 'individu') => 'bg-orange-50 text-orange-600 border-orange-100',
                                                default => 'bg-blue-50 text-blue-600 border-blue-100',
                                            };
                                        @endphp
                                        <span class="inline-flex px-2 py-1 rounded-lg text-[9px] font-black uppercase border {{ $styleColor }}">
                                            {{ $item->work_style }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-6 align-top">
                                        @php
                                            $path = strtolower($item->career_path ?? '');
                                            $pathBadge = match($path) {
                                                'bekerja' => ['bg' => 'bg-emerald-500', 'label' => 'Bekerja'],
                                                'melanjutkan' => ['bg' => 'bg-blue-500', 'label' => 'Melanjutkan'],
                                                'wirausaha' => ['bg' => 'bg-amber-500', 'label' => 'Wirausaha'],
                                                default => ['bg' => 'bg-gray-400', 'label' => 'Belum Pilih'],
                                            };
                                        @endphp
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full {{ $pathBadge['bg'] }}"></div>
                                            <span class="text-xs font-bold text-gray-700">{{ $pathBadge['label'] }}</span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-6 align-top">
                                        <div class="text-[11px] font-bold text-gray-800 leading-tight">{{ $item->pelajaran_favorit }}</div>
                                        <div class="text-[10px] text-gray-400 mt-1 italic line-clamp-1">"{{ $item->hobi }}"</div>
                                    </td>

                                    <td class="px-6 py-6 align-top">
                                        <div class="bg-gray-50/50 p-3 rounded-xl border border-gray-100 group-hover:bg-white transition-colors">
                                            <p class="text-[10px] text-gray-600 leading-relaxed line-clamp-2">
                                                {{ $item->cita_cita_keluhan ?? 'Tidak ada pesan.' }}
                                            </p>
                                            @if($item->cita_cita_keluhan)
                                            <button 
                                                @click="openModal = true; modalData = { 
                                                    name: '{{ $item->user->name }}', 
                                                    content: '{{ e($item->cita_cita_keluhan) }}',
                                                    path: '{{ $pathBadge['label'] }}'
                                                }"
                                                class="mt-2 text-[9px] font-black text-teal-600 uppercase hover:underline">
                                                Lihat Detail
                                            </button>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-8 py-6 align-top text-right">
                                        <div class="flex flex-col items-end gap-2">
                                            <form action="{{ route('admin.minat-karir.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-300 hover:text-red-600 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                            <span class="text-[8px] font-black text-gray-300 uppercase">{{ $item->created_at->format('d M') }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="px-8 py-20 text-center text-gray-400 font-bold">Belum ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

            {{-- Sidebar Info (Kanan) dengan Chart --}}
            <aside class="w-80 bg-white border-l border-gray-100 p-8 hidden xl:flex flex-col overflow-y-auto">
                <div class="mb-10">
                    <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Visualisasi BMW</h3>
                    
                    {{-- Box Grafik --}}
                    <div class="relative bg-gray-50 rounded-[2.5rem] p-6 mb-8 border border-gray-100 shadow-inner" style="height: 240px;">
                        <canvas id="bmwChart"></canvas>
                    </div>

                    <div class="space-y-4">
                        <div class="bg-gray-900 p-6 rounded-[2rem] text-white shadow-xl">
                            <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-1">Total Laporan</p>
                            <h4 class="text-4xl font-black">{{ $dataKarir->count() }}</h4>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-emerald-50 p-3 rounded-2xl text-center border border-emerald-100">
                                <p class="text-[8px] font-black text-emerald-600 uppercase">B</p>
                                <p class="text-sm font-black text-emerald-700">{{ $dataKarir->where('career_path', 'Bekerja')->count() }}</p>
                            </div>
                            <div class="bg-blue-50 p-3 rounded-2xl text-center border border-blue-100">
                                <p class="text-[8px] font-black text-blue-600 uppercase">M</p>
                                <p class="text-sm font-black text-blue-700">{{ $dataKarir->where('career_path', 'Melanjutkan')->count() }}</p>
                            </div>
                            <div class="bg-amber-50 p-3 rounded-2xl text-center border border-amber-100">
                                <p class="text-[8px] font-black text-amber-600 uppercase">W</p>
                                <p class="text-sm font-black text-amber-700">{{ $dataKarir->where('career_path', 'Wirausaha')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50/50 p-6 rounded-[2rem] border border-gray-100">
                    <h3 class="text-xs font-black text-gray-900 uppercase tracking-widest mb-6">Indikator BMW</h3>
                    <div class="space-y-5 text-[10px] font-black uppercase">
                        <div class="flex items-center gap-4 text-emerald-600"><div class="w-2 h-2 rounded-full bg-emerald-500"></div> Bekerja</div>
                        <div class="flex items-center gap-4 text-blue-600"><div class="w-2 h-2 rounded-full bg-blue-500"></div> Melanjutkan</div>
                        <div class="flex items-center gap-4 text-amber-600"><div class="w-2 h-2 rounded-full bg-amber-500"></div> Wirausaha</div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    {{-- MODAL POPUP --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[99] flex items-center justify-center p-6 bg-gray-900/60 backdrop-blur-sm"
         x-transition
         x-cloak>
        <div class="bg-white w-full max-w-xl rounded-[2.5rem] shadow-2xl p-8" @click.away="openModal = false">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="text-xl font-black text-gray-900">Detail Eksplorasi</h3>
                    <p class="text-xs text-gray-400 font-bold">Siswa: <span class="text-teal-600" x-text="modalData.name"></span></p>
                </div>
                <button @click="openModal = false" class="text-gray-400 hover:text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            <div class="bg-teal-50/50 p-6 rounded-3xl border border-teal-50">
                <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line" x-text="modalData.content"></p>
            </div>
            <button @click="openModal = false" class="mt-8 w-full py-4 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest">Tutup</button>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>

{{-- SCRIPT GRAFIK --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil data dari Laravel/Blade
        const dataStats = [
            {{ $dataKarir->where('career_path', 'Bekerja')->count() }},
            {{ $dataKarir->where('career_path', 'Melanjutkan')->count() }},
            {{ $dataKarir->where('career_path', 'Wirausaha')->count() }}
        ];

        const ctx = document.getElementById('bmwChart');

        if (ctx && typeof Chart !== 'undefined') {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Bekerja', 'Melanjutkan', 'Wirausaha'],
                    datasets: [{
                        data: dataStats,
                        backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                        borderWidth: 6,
                        borderColor: '#f9fafb',
                        hoverOffset: 12
                    }]
                },
                options: {
                    cutout: '70%',
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        }
    });
</script>
@endsection