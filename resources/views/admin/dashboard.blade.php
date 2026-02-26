@extends('layouts.app')

@section('title', 'Admin Dashboard - SMKN 43 JAKARTA')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen bg-[#F8FAFC] flex overflow-hidden"
    x-data="{ 
        openModal: false, 
        openCollabModal: false, 
        openEditCollabModal: false,
        activeMessage: '', 
        activeName: '',
        activeCollab: { id: '', nama: '', deskripsi: '', link: '' }
     }">

    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        {{-- Main Scrollable Area --}}
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <div class="flex flex-col lg:flex-row h-full">

                {{-- MAIN CONTENT (LEFT) --}}
                <main class="flex-1 p-6 lg:p-8 space-y-8">

                    {{-- Welcome Header --}}
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Ringkasan Utama</h1>
                            <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Panel Kendali Guru BK • SMKN 43 Jakarta</p>
                        </div>
                        <div class="hidden md:block">
                            <span class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-[11px] font-bold text-slate-500 uppercase tracking-wider shadow-sm">
                                {{ now()->format('d F Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Stats Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Card Total Siswa --}}
                        <a href="{{ route('admin.siswa') }}" class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm relative overflow-hidden group hover:shadow-md hover:border-teal-200 transition-all">
                            <div class="absolute -right-6 -top-6 w-24 h-24 bg-teal-50 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
                            <div class="relative">
                                <div class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-teal-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-1">Total Siswa Terdaftar</p>
                                    <svg class="w-3 h-3 text-teal-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                                <p class="text-4xl font-black text-slate-900">{{ $totalSiswa ?? '0' }}</p>
                            </div>
                        </a>

                        {{-- Card Antrean Pending (SEKARANG BISA DIKLIK) --}}
                        <a href="{{ route('admin.layanan.tindak-lanjut') }}" class="p-6 bg-white border border-slate-100 rounded-[2rem] shadow-sm relative overflow-hidden group hover:shadow-md hover:border-orange-200 transition-all">
                            <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-50 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
                            <div class="relative">
                                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white mb-4 shadow-lg shadow-orange-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center gap-2">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em] mb-1">Antrean Pending</p>
                                    <svg class="w-3 h-3 text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                                <p class="text-4xl font-black text-orange-600">{{ $requests->where('status', 'pending')->count() }}</p>
                            </div>
                        </a>
                    </div>

                    {{-- Table Antrean --}}
                    <div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-sm overflow-hidden">
                        <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center bg-white">
                            <h2 class="text-lg font-black text-slate-900 tracking-tight">Antrean Konseling Terbaru</h2>
                            <a href="{{ route('admin.layanan.tindak-lanjut') }}" class="text-[10px] font-black text-teal-600 uppercase tracking-widest hover:underline">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-slate-50/50">
                                        <th class="px-8 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa</th>
                                        <th class="px-8 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Pesan</th>
                                        <th class="px-8 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @forelse($requests->take(5) as $req)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="font-bold text-slate-900 text-sm">{{ $req->user->name ?? $req->nama_siswa }}</div>
                                            <div class="text-[10px] text-slate-400">{{ $req->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-8 py-5">
                                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-full text-[10px] font-bold uppercase tracking-wide">
                                                {{ Str::limit($req->message, 40) }}
                                            </span>
                                        </td>
                                        <td class="px-8 py-5 text-center">
                                            <button @click="openModal = true; activeName='{{ $req->user->name ?? $req->nama_siswa }}'; activeMessage='{{ $req->message }}'"
                                                class="p-2 hover:bg-teal-50 text-teal-600 rounded-lg transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-8 py-10 text-center text-slate-400 text-xs italic">Belum ada antrean masuk hari ini.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- ANALYTICS CHART SECTION --}}
                    <div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-sm p-8 relative overflow-hidden group">
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-teal-50/50 rounded-full blur-3xl"></div>
                        <div class="relative">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                                <div>
                                    <h2 class="text-xl font-black text-slate-900 tracking-tight">Statistik Konsultasi</h2>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">
                                        Volume Aktivitas Siswa Tahun {{ $selectedYear }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.dashboard') }}" method="GET" id="yearForm">
                                    <select name="year" onchange="document.getElementById('yearForm').submit()"
                                        class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-700 outline-none focus:ring-2 focus:ring-teal-500 transition-all cursor-pointer">
                                        @foreach($availableYears as $year)
                                        <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>Tahun {{ $year }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </div>
                            <div class="h-[320px] w-full"><canvas id="counselingChart"></canvas></div>
                        </div>
                    </div>
                </main>

                {{-- SIDEBAR KOLABORASI (RIGHT) --}}
                <aside class="w-full lg:w-[320px] bg-[#F1F5F9]/30 border-l border-slate-100 p-6 lg:p-8 space-y-8 h-full overflow-y-auto">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-sm font-black text-slate-900 uppercase tracking-tighter">Mitra Industri</h2>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">Kolaborasi Aktif</p>
                        </div>
                        <button @click="openCollabModal = true" class="w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center hover:bg-teal-600 transition-all shadow-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        @forelse($kolaborators ?? [] as $collab)
                        <div class="group relative p-4 bg-white rounded-2xl border border-slate-100 hover:border-teal-200 hover:shadow-sm transition-all">
                            {{-- Klik Logo/Nama Ke Link --}}
                            <a href="{{ $collab->link ?? '#' }}" target="_blank" class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-50 flex-shrink-0 overflow-hidden flex items-center justify-center border border-slate-100 group-hover:border-teal-100 transition-colors">
                                    @if($collab->logo)
                                    <img src="{{ Storage::url($collab->logo) }}" class="w-full h-full object-cover">
                                    @else
                                    <span class="text-[10px] font-black text-slate-300 uppercase">{{ substr($collab->nama, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-xs font-black text-slate-900 truncate leading-none">{{ $collab->nama }}</h4>
                                    <p class="text-[9px] text-slate-400 mt-1 truncate">{{ $collab->deskripsi }}</p>
                                </div>
                            </a>

                            {{-- Floating Action Buttons (Hanya muncul saat hover) --}}
                            <div class="absolute -top-2 -right-2 hidden group-hover:flex items-center gap-1 bg-white p-1 rounded-xl shadow-lg border border-slate-100">
                                <button @click="activeCollab = {{ json_encode($collab) }}; openEditCollabModal = true" class="p-1.5 text-teal-600 hover:bg-teal-50 rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </button>
                                <form action="{{ route('admin.kolaborasi.destroy', $collab->id) }}" method="POST" onsubmit="return confirm('Hapus mitra ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 px-4 border-2 border-dashed border-slate-200 rounded-[2rem]">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Belum ada mitra</p>
                        </div>
                        @endforelse
                    </div>
                </aside>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL PESAN --}}
    <div x-show="openModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white rounded-[2.5rem] p-10 max-w-md w-full relative shadow-2xl">
            <h3 class="text-xl font-black text-slate-900 mb-2" x-text="activeName"></h3>
            <p class="text-[10px] text-teal-600 font-black uppercase tracking-widest mb-6 border-b pb-4">Detail Keluhan / Masalah</p>
            <p class="text-slate-600 text-sm italic leading-relaxed" x-text="'&quot;' + activeMessage + '&quot;'"></p>
            <button @click="openModal = false" class="w-full mt-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-teal-600 transition-all shadow-lg">Tutup Detail</button>
        </div>
    </div>

    {{-- MODAL TAMBAH KOLABORASI --}}
    <div x-show="openCollabModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-lg w-full p-8 relative overflow-hidden" @click.away="openCollabModal = false">
            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-8">Tambah Mitra Industri</h3>
            <form action="{{ route('admin.kolaborasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Nama Perusahaan</label>
                    <input type="text" name="nama" required class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-teal-500 transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="2" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="url" name="link" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm" placeholder="URL Website (https://..)">
                    <input type="file" name="logo" accept="image/*" class="w-full text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-teal-50 file:text-teal-700">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" @click="openCollabModal = false" class="flex-1 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-[10px] uppercase tracking-widest">Batal</button>
                    <button type="submit" class="flex-1 py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-600 shadow-lg transition-all">Simpan Mitra</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT KOLABORASI --}}
    <div x-show="openEditCollabModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-cloak x-transition>
        <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-lg w-full p-8 relative overflow-hidden" @click.away="openEditCollabModal = false">
            <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-8">Edit Mitra Industri</h3>
            <form :action="'/admin/kolaborasi/' + activeCollab.id" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Nama Perusahaan</label>
                    <input type="text" name="nama" x-model="activeCollab.nama" required class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2 ml-1">Deskripsi</label>
                    <textarea name="deskripsi" x-model="activeCollab.deskripsi" rows="2" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm outline-none focus:ring-2 focus:ring-teal-500"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="url" name="link" x-model="activeCollab.link" class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-2xl text-sm" placeholder="Website URL">
                    <input type="file" name="logo" accept="image/*" class="w-full text-[10px] text-slate-500">
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="button" @click="openEditCollabModal = false" class="flex-1 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-[10px] uppercase tracking-widest">Batal</button>
                    <button type="submit" class="flex-1 py-4 bg-teal-600 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-700 shadow-lg transition-all">Perbarui Mitra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #E2E8F0;
        border-radius: 10px;
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('counselingChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(13, 148, 136, 0.2)');
        gradient.addColorStop(1, 'rgba(13, 148, 136, 0.0)');

        const dataCounts = @json($counts ?? array_fill(0, 12, 0));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Siswa Konsultasi',
                    data: dataCounts,
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: '#0D9488',
                    borderWidth: 3,
                    pointBackgroundColor: '#FFF',
                    pointBorderColor: '#0D9488',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#0F172A',
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(226, 232, 240, 0.5)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                size: 10,
                                weight: '600'
                            },
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                size: 10,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection