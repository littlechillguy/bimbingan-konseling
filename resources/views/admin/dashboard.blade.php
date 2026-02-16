@extends('layouts.app')

@section('title', 'Admin Dashboard - Tenang.id')

@section('content')
    <div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden">
        <aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col sticky top-0 h-screen pt-8 pb-10 px-6">
            <div class="flex items-center gap-3 px-4 mb-10">
                <img src="{{ asset('asset/logo43.png') }}" class="w-10 h-10" alt="Logo">
                <span class="text-xl font-black text-gray-900 tracking-tight">Tenang<span
                        class="text-teal-600">.id</span></span>
            </div>

            <nav class="space-y-1 flex-1 overflow-y-auto custom-scrollbar">
                <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Main Menu</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 p-3 bg-teal-50 text-teal-600 rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="text-sm">Dashboard</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="text-sm">Jadwal Masuk</span>
                </a>

                <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest mt-6 mb-2">Layanan BK</p>
                <a href="#"
                    class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="text-sm">Hasil Konseling</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7">
                        </path>
                    </svg>
                    <span class="text-sm">Tindak Lanjut</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="text-sm">Home Visit</span>
                </a>
                <a href="#"
                    class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span class="text-sm">Minat Karir</span>
                </a>
            </nav>

            <div class="border-t border-gray-100 pt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center space-x-3 p-4 text-red-500 hover:bg-red-50 rounded-2xl font-bold transition w-full text-left">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-y-auto">
            <header
                class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-50 flex items-center justify-between px-6 lg:px-10 sticky top-0 z-20">
                <h2 class="font-bold text-gray-800 hidden md:block">Dashboard Overview</h2>
                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-teal-600 font-black uppercase tracking-widest mt-1">Administrator BK</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D9488&color=fff"
                        class="w-10 h-10 rounded-xl border-2 border-white shadow-sm" alt="Avatar">
                </div>
            </header>

            <div class="flex flex-col xl:flex-row gap-0">
                <main class="flex-1 p-6 lg:p-10">
                    <header class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-black text-gray-900 leading-tight">Ringkasan Utama 👋</h1>
                            <p class="text-gray-500 font-medium">Data bimbingan siswa per hari ini.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button
                                class="px-4 py-2.5 bg-white border border-gray-100 rounded-xl font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition text-sm">Export
                                Data</button>
                        </div>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        <div class="p-6 bg-white border border-gray-100 rounded-[2rem] shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Siswa</p>
                            <p class="text-3xl font-black text-gray-900">1,240</p>
                        </div>
                        <div class="p-6 bg-white border border-gray-100 rounded-[2rem] shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Sesi Aktif</p>
                            <p class="text-3xl font-black text-gray-900">18</p>
                        </div>
                        <div class="p-6 bg-white border border-gray-100 rounded-[2rem] shadow-sm">
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Permintaan</p>
                            <p class="text-3xl font-black text-gray-900">5</p>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-gray-50">
                            <h2 class="text-xl font-bold text-gray-900">Antrean Konseling</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse text-sm">
                                <thead>
                                    <tr class="bg-gray-50/50 text-gray-400 font-black uppercase tracking-tighter">
                                        <th class="px-8 py-4 text-[10px]">Siswa</th>
                                        <th class="px-8 py-4 text-[10px]">Layanan</th>
                                        <th class="px-8 py-4 text-[10px]">Status</th>
                                        <th class="px-8 py-4 text-[10px] text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 font-medium">
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-8 py-4">
                                            <p class="font-bold text-gray-900 leading-none">Andhika Pratama</p>
                                            <span class="text-[10px] text-gray-400">XII RPL 1</span>
                                        </td>
                                        <td class="px-8 py-4">
                                            <span
                                                class="px-2 py-1 bg-teal-50 text-teal-600 text-[10px] font-black rounded-lg">Pribadi</span>
                                        </td>
                                        <td class="px-8 py-4">
                                            <span class="text-orange-500 font-bold text-[11px]">Pending</span>
                                        </td>
                                        <td class="px-8 py-4">
                                            <div class="flex justify-center gap-2">
                                                <button class="p-1.5 bg-teal-50 text-teal-600 rounded-lg"><svg
                                                        class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg></button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>

                <aside class="w-full xl:w-80 p-6 lg:p-10 bg-gray-50/50 border-l border-gray-100">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-lg font-black text-gray-900">Kolaborasi</h3>
                        <button
                            class="p-2 bg-teal-600 text-white rounded-xl shadow-lg shadow-teal-100 hover:scale-105 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="p-5 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition cursor-pointer group">
                            <div class="flex items-center gap-3 mb-3">
                                <div
                                    class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xs italic">
                                    W</div>
                                <div>
                                    <h4 class="text-sm font-black text-gray-900">Wali Kelas XII</h4>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase">Sudah Dihubungi</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 line-clamp-2">Membahas perkembangan akademik siswa berinisial AP
                                terkait kehadiran...</p>
                        </div>

                        <div
                            class="p-5 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition cursor-pointer group">
                            <div class="flex items-center gap-3 mb-3">
                                <div
                                    class="w-8 h-8 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center font-bold text-xs italic">
                                    O</div>
                                <div>
                                    <h4 class="text-sm font-black text-gray-900">Orang Tua Murid</h4>
                                    <p class="text-[10px] text-orange-500 font-bold uppercase tracking-widest">Menunggu
                                        Balasan</p>
                                </div>
                            </div>
                            <p class="text-xs text-gray-500 line-clamp-2">Permintaan pertemuan tatap muka di sekolah hari
                                Jumat pukul 10.00.</p>
                        </div>

                        <button
                            class="w-full py-4 border-2 border-dashed border-gray-200 rounded-2xl text-gray-400 text-xs font-bold hover:border-teal-400 hover:text-teal-500 transition-all flex flex-col items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Tambah Kolaborasi Baru
                        </button>
                    </div>
                </aside>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }
    </style>
@endsection