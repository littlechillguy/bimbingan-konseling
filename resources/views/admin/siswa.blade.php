@extends('layouts.app')

@section('content')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen bg-[#F8FAFC] flex overflow-hidden" 
     x-data="{ 
        search: '', 
        openModal: false, 
        s: {} {{-- Tempat menyimpan data siswa yang dipilih --}}
     }">

    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <main class="flex-1 overflow-y-auto p-6 lg:p-10 space-y-8 custom-scrollbar">
            {{-- Header & Search (Sama seperti sebelumnya) --}}
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tight">Database Siswa</h1>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-[0.2em] mt-2">Total {{ $siswas->total() }} Siswa Terdaftar</p>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" x-model="search" placeholder="Cari nama, NISN, atau email..."
                        class="w-full pl-12 pr-5 py-3 bg-white border border-slate-200 rounded-2xl text-sm focus:ring-2 focus:ring-teal-500 outline-none shadow-sm">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>

            {{-- Table --}}
            <div class="bg-white border border-slate-100 rounded-[2.5rem] shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                <th class="px-8 py-5">No</th>
                                <th class="px-8 py-5">Nama & NISN</th>
                                <th class="px-8 py-5">Kontak</th>
                                <th class="px-8 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($siswas as $index => $siswa)
                            <tr class="hover:bg-slate-50/50 transition-colors"
                                x-show="search === '' || '{{ strtolower($siswa->name) }}'.includes(search.toLowerCase()) || '{{ $siswa->nisn }}'.includes(search)">
                                <td class="px-8 py-5 text-sm font-bold text-slate-400">{{ $siswas->firstItem() + $index }}</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 bg-teal-100 text-teal-700 rounded-xl flex items-center justify-center font-black text-xs">
                                            {{ strtoupper(substr($siswa->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-900 text-sm leading-none">{{ $siswa->name }}</p>
                                            <p class="text-[10px] text-slate-400 font-medium mt-1">NISN: {{ $siswa->nisn ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-sm text-slate-500">{{ $siswa->kontak_siswa ?? $siswa->email }}</td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-2">
                                        <button @click="s = {
                                            name: '{{ $siswa->name }}',
                                            username: '{{ $siswa->username }}',
                                            email: '{{ $siswa->email }}',
                                            nis: '{{ $siswa->nis ?? '-' }}',
                                            nisn: '{{ $siswa->nisn ?? '-' }}',
                                            ttl: '{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d M Y') }}',
                                            smp: '{{ $siswa->asal_smp ?? '-' }}',
                                            ortu: '{{ $siswa->nama_orangtua ?? '-' }}',
                                            hp_siswa: '{{ $siswa->kontak_siswa ?? '-' }}',
                                            hp_ortu: '{{ $siswa->kontak_orangtua ?? '-' }}',
                                            penyakit: '{{ $siswa->riwayat_penyakit ?? 'Tidak Ada' }}',
                                            mutasi: '{{ $siswa->is_mutasi ? 'Siswa Pindahan' : 'Siswa Reguler' }}',
                                            joined: '{{ $siswa->created_at->format('d M Y') }}'
                                        }; openModal = true" 
                                        class="p-2 hover:bg-teal-50 text-teal-600 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            ...
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-8 py-5 bg-slate-50/50 border-t border-slate-50">{{ $siswas->links() }}</div>
            </div>
        </main>

        {{-- MODAL DETAIL LENGKAP --}}
        <div x-show="openModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" x-cloak>
            <div class="bg-white rounded-[2.5rem] shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col" @click.away="openModal = false">
                <div class="p-8 overflow-y-auto custom-scrollbar">
                    <div class="flex justify-between items-start mb-8">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 bg-teal-600 text-white rounded-2xl flex items-center justify-center text-2xl font-black shadow-lg shadow-teal-100" x-text="s.name ? s.name.charAt(0) : ''"></div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900" x-text="s.name"></h3>
                                <p class="text-sm text-teal-600 font-bold uppercase tracking-widest" x-text="s.mutasi"></p>
                            </div>
                        </div>
                        <button @click="openModal = false" class="text-slate-300 hover:text-slate-500 transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        {{-- Data Akademik --}}
                        <div class="space-y-4">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b pb-2">Informasi Akademik</h4>
                            <div><p class="text-[10px] text-slate-400 uppercase font-bold">Username / NIS</p><p class="text-sm font-bold text-slate-700" x-text="s.username + ' / ' + s.nis"></p></div>
                            <div><p class="text-[10px] text-slate-400 uppercase font-bold">NISN</p><p class="text-sm font-bold text-slate-700" x-text="s.nisn"></p></div>
                            <div><p class="text-[10px] text-slate-400 uppercase font-bold">Asal SMP</p><p class="text-sm font-bold text-slate-700" x-text="s.smp"></p></div>
                        </div>
                        {{-- Data Pribadi --}}
                        <div class="space-y-4">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] border-b pb-2">Profil Pribadi</h4>
                            <div><p class="text-[10px] text-slate-400 uppercase font-bold">Tempat, Tanggal Lahir</p><p class="text-sm font-bold text-slate-700" x-text="s.ttl"></p></div>
                            <div><p class="text-[10px] text-slate-400 uppercase font-bold">Email</p><p class="text-sm font-bold text-slate-700" x-text="s.email"></p></div>
                            <div><p class="text-[10px] text-slate-400 uppercase font-bold">Riwayat Penyakit</p><p class="text-sm font-bold text-red-500" x-text="s.penyakit"></p></div>
                        </div>
                        {{-- Kontak & Ortu --}}
                        <div class="space-y-4 md:col-span-2 bg-slate-50 p-6 rounded-3xl">
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Kontak Keluarga</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div><p class="text-[10px] text-slate-400 uppercase font-bold">Nama Orang Tua</p><p class="text-sm font-bold text-slate-700" x-text="s.ortu"></p></div>
                                <div><p class="text-[10px] text-slate-400 uppercase font-bold">HP Siswa</p><p class="text-sm font-bold text-slate-700" x-text="s.hp_siswa"></p></div>
                                <div><p class="text-[10px] text-slate-400 uppercase font-bold">HP Orang Tua</p><p class="text-sm font-bold text-slate-700" x-text="s.hp_ortu"></p></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-8 bg-slate-50 border-t border-slate-100">
                    <button @click="openModal = false" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-teal-600 transition-all shadow-lg shadow-slate-200">Tutup Profil</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection