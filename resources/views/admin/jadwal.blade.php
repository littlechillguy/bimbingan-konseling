@extends('layouts.app') 

@section('page_title', 'Manajemen Jadwal BK') {{-- Teks ini akan muncul di navbar --}}

@section('content')
<div class="flex h-screen bg-gray-100">
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('admin.partials.navbar')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                    <div>
                        <h3 class="text-3xl font-bold text-gray-800">Manajemen Jadwal</h3>
                        <p class="text-gray-500 mt-1">Atur jam operasional layanan bimbingan konseling.</p>
                    </div>
                    
                    @php
                        $hariIni = date('N'); // 1 (Senin) - 7 (Minggu)
                        $jamSekarang = date('H:i');
                        $isWeekend = ($hariIni > 5);
                        $isBuka = (!$isWeekend && $jamSekarang >= '07:30' && $jamSekarang <= '15:30');
                    @endphp

                    <div class="mt-4 md:mt-0">
                        @if($isBuka)
                            <span class="flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-full font-bold text-sm border border-green-200 shadow-sm">
                                <span class="relative flex h-3 w-3">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                                Ruang BK Sedang Buka
                            </span>
                        @else
                            <span class="flex items-center gap-2 px-4 py-2 bg-rose-100 text-rose-700 rounded-full font-bold text-sm border border-rose-200 shadow-sm">
                                <span class="h-3 w-3 rounded-full bg-rose-500"></span>
                                Ruang BK Sedang Tutup
                            </span>
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                        <h4 class="font-bold text-gray-700">Tabel Jam Operasional</h4>
                        <button class="px-4 py-2 bg-teal-600 text-white text-sm font-bold rounded-xl hover:bg-teal-700 transition-all">
                            Edit Jadwal
                        </button>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Hari</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Sesi Pagi</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Sesi Siang</th>
                                    <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php
                                    $days = [
                                        ['day' => 'Senin', 'pagi' => '07:30 - 12:00', 'siang' => '13:00 - 15:30', 'note' => 'Aktif'],
                                        ['day' => 'Selasa', 'pagi' => '07:30 - 12:00', 'siang' => '13:00 - 15:30', 'note' => 'Aktif'],
                                        ['day' => 'Rabu', 'pagi' => '07:30 - 12:00', 'siang' => '13:00 - 15:30', 'note' => 'Aktif'],
                                        ['day' => 'Kamis', 'pagi' => '07:30 - 12:00', 'siang' => '13:00 - 15:30', 'note' => 'Aktif'],
                                        ['day' => 'Jumat', 'pagi' => '07:30 - 11:30', 'siang' => '13:30 - 15:30', 'note' => 'Sesi Terbatas'],
                                    ];
                                @endphp

                                @foreach($days as $d)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5 font-bold text-gray-700">{{ $d['day'] }}</td>
                                    <td class="px-6 py-5 text-gray-600 text-sm">{{ $d['pagi'] }}</td>
                                    <td class="px-6 py-5 text-gray-600 text-sm">{{ $d['siang'] }}</td>
                                    <td class="px-6 py-5">
                                        <span class="px-3 py-1 {{ $loop->last ? 'bg-amber-100 text-amber-700' : 'bg-teal-100 text-teal-700' }} rounded-lg text-xs font-bold">
                                            {{ $d['note'] }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-8 bg-slate-800 rounded-3xl p-6 text-white flex items-center gap-6">
                    <div class="h-12 w-12 bg-white/10 rounded-2xl flex items-center justify-center text-2xl">
                        📢
                    </div>
                    <div>
                        <h5 class="font-bold">Informasi Halaman Publik</h5>
                        <p class="text-slate-400 text-sm">Data di atas disinkronkan langsung ke halaman "Jadwal Masuk" yang dilihat oleh siswa. Pastikan perubahan dilakukan sesuai instruksi kepala sekolah.</p>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>
@endsection