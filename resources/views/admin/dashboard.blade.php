@extends('layouts.app')

@section('title', 'Admin Dashboard - SMKN 43 JAKARTA')
@section('page_title', 'Dashboard Overview')

@section('content')
    <div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden">
        
        @include('admin.partials.sidebar')

        <div class="flex-1 flex flex-col h-screen overflow-y-auto">
            
            @include('admin.partials.navbar')

            <div class="flex flex-col xl:flex-row gap-0">
                <main class="flex-1 p-6 lg:p-10">
                    
                    @if(session('success'))
                    <div class="mb-8 p-4 bg-teal-50 border border-teal-100 rounded-2xl flex items-center gap-3 animate-bounce">
                        <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-teal-900">Sistem Update</p>
                            <p class="text-xs text-teal-700">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <header class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-black text-gray-900 leading-tight">Ringkasan Utama 👋</h1>
                            <p class="text-gray-500 font-medium">Data bimbingan siswa per hari ini.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="px-4 py-2.5 bg-white border border-gray-100 rounded-xl font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition text-sm">
                                Export Data
                            </button>
                        </div>
                    </header>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                        <div class="p-6 bg-white border border-gray-100 rounded-[2rem] shadow-sm relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 w-20 h-20 bg-teal-50 rounded-full transition-transform group-hover:scale-150"></div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1 relative">Total Siswa</p>
                            <p class="text-3xl font-black text-gray-900 relative">1,240</p>
                        </div>
                        </div>

                    <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm overflow-hidden">
                        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
                            <h2 class="text-xl font-bold text-gray-900">Antrean Konseling</h2>
                            <span class="px-3 py-1 bg-orange-100 text-orange-600 text-[10px] font-black rounded-full uppercase">Perlu Tindakan</span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            {{-- Nanti gunakan @if($antrean->isEmpty()) --}}
                            <table class="w-full text-left border-collapse text-sm">
                                <tbody class="divide-y divide-gray-50 font-medium">
                                    {{-- Contoh Row --}}
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-8 py-4">
                                            <p class="font-bold text-gray-900">Andhika Pratama</p>
                                            <span class="text-[10px] text-gray-400">XII RPL 1</span>
                                        </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>

                <aside class="w-full xl:w-80 p-6 lg:p-10 bg-gray-50/50 border-l border-gray-100">
                    <h3 class="text-lg font-black text-gray-900 mb-6">Aktivitas Real-time</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4 relative">
                            <div class="absolute left-4 top-8 bottom-0 w-0.5 bg-gray-100"></div>
                            <div class="w-8 h-8 rounded-full bg-blue-500 border-4 border-white shadow-sm flex-shrink-0 z-10"></div>
                            <div>
                                <p class="text-xs font-bold text-gray-900 leading-none">Antrean Baru!</p>
                                <p class="text-[10px] text-gray-500 mt-1">2 menit yang lalu</p>
                            </div>
                        </div>
                        </div>
                </aside>
            </div>
        </div>
    </div>
@endsection