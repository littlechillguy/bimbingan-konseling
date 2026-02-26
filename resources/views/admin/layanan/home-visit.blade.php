@extends('layouts.app')

@section('title', 'Home Visit - SMKN 43 JAKARTA')
@section('page_title', 'Layanan BK / Home Visit')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style> 
    [x-cloak] { display: none !important; } 
    .swal2-popup { font-family: inherit !important; }
</style>

<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden" 
     x-data="{ 
        openModal: false, 
        isEdit: false, 
        selectedVisit: {} 
     }">
    
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <main class="flex-1 overflow-y-auto p-6 lg:p-10">
            <div class="max-w-5xl mx-auto w-full">
                
                {{-- FORM INPUT UTAMA --}}
                <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm p-8 mb-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Input Kunjungan Rumah</h3>
                            <p class="text-sm text-gray-500 font-medium">Dokumentasikan laporan baru.</p>
                        </div>
                    </div>
                    <form action="{{ route('admin.home-visit.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <input type="text" name="nama_siswa" required placeholder="Nama Siswa" class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition">
                        
                        <input type="text" name="nama_orang_tua" required placeholder="Nama Orang Tua / Wali" class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition">
                        
                        <input type="date" name="tanggal_kunjungan" required class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition">
                        
                        <input type="text" name="alamat" required placeholder="Alamat Lengkap" class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition">
                        
                        <textarea name="keterangan" rows="3" required placeholder="Keterangan hasil kunjungan..." class="md:col-span-2 w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition"></textarea>
                        
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="px-8 py-3 bg-teal-600 text-white font-black rounded-xl hover:bg-teal-700 transition shadow-lg shadow-teal-100">Simpan Laporan</button>
                        </div>
                    </form>
                </div>

                {{-- TABEL RIWAYAT --}}
                <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm overflow-hidden mb-10">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50 text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <th class="px-8 py-4">Siswa & Orang Tua</th>
                                <th class="px-8 py-4 text-center">Tanggal</th>
                                <th class="px-8 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($visits as $visit)
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-8 py-5">
                                    <div class="text-sm font-bold text-gray-900">{{ $visit->nama_siswa }}</div>
                                    <div class="text-[10px] text-teal-600 font-black uppercase tracking-tighter">Ortu: {{ $visit->nama_orang_tua ?? '-' }}</div>
                                </td>
                                <td class="px-8 py-5 text-center text-sm font-bold text-gray-600">
                                    {{ \Carbon\Carbon::parse($visit->tanggal_kunjungan)->format('d/m/Y') }}
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex justify-center gap-3">
                                        <button @click="selectedVisit = { 
                                            id: '{{ $visit->id }}',
                                            nama: '{{ $visit->nama_siswa }}', 
                                            ortu: '{{ $visit->nama_orang_tua }}',
                                            tgl: '{{ $visit->tanggal_kunjungan }}',
                                            alamat: '{{ $visit->alamat }}',
                                            ket: '{{ addslashes($visit->keterangan) }}'
                                        }; isEdit = false; openModal = true" 
                                        class="p-2 text-gray-400 hover:text-teal-600 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>

                                        <form action="{{ route('admin.home-visit.destroy', $visit->id) }}" method="POST" class="delete-form">
                                            @csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete(this)" class="p-2 text-gray-400 hover:text-red-500 transition">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-8 py-10 text-center text-gray-400 font-medium">Belum ada data kunjungan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    {{-- MODAL GABUNGAN (Detail & Edit) --}}
    <div x-show="openModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-cloak>
        
        <div @click.away="openModal = false" class="bg-white rounded-[2.5rem] shadow-2xl max-w-lg w-full overflow-hidden border border-gray-100">
            
            <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                <h3 class="text-lg font-black text-gray-900" x-text="isEdit ? 'Edit Laporan' : 'Detail Kunjungan'"></h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form :action="'{{ url('/admin/home-visit') }}/' + selectedVisit.id" method="POST">
                @csrf @method('PUT')
                <div class="p-8 space-y-6">
                    {{-- Mode DETAIL --}}
                    <template x-if="!isEdit">
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Siswa</label>
                                    <p class="text-sm font-bold text-gray-900" x-text="selectedVisit.nama"></p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Orang Tua</label>
                                    <p class="text-sm font-bold text-gray-900" x-text="selectedVisit.ortu || '-'"></p>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</label>
                                    <p class="text-sm font-bold text-gray-700" x-text="selectedVisit.tgl"></p>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat</label>
                                    <p class="text-xs font-medium text-gray-600" x-text="selectedVisit.alamat"></p>
                                </div>
                            </div>
                            <div class="p-4 bg-teal-50 rounded-2xl border border-teal-100">
                                <label class="text-[10px] font-black text-teal-600 uppercase tracking-widest mb-1 block">Hasil Kunjungan</label>
                                <p class="text-sm text-gray-700 leading-relaxed italic" x-text="selectedVisit.ket"></p>
                            </div>
                        </div>
                    </template>

                    {{-- Mode EDIT --}}
                    <template x-if="isEdit">
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs font-bold text-gray-400 ml-1 mb-1 block">Nama Siswa</label>
                                    <input type="text" name="nama_siswa" x-model="selectedVisit.nama" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-400 ml-1 mb-1 block">Nama Orang Tua</label>
                                    <input type="text" name="nama_orang_tua" x-model="selectedVisit.ortu" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs font-bold text-gray-400 ml-1 mb-1 block">Tanggal</label>
                                    <input type="date" name="tanggal_kunjungan" x-model="selectedVisit.tgl" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-400 ml-1 mb-1 block">Alamat</label>
                                    <input type="text" name="alamat" x-model="selectedVisit.alamat" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none">
                                </div>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 ml-1 mb-1 block">Keterangan</label>
                                <textarea name="keterangan" rows="4" x-model="selectedVisit.ket" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-teal-500 outline-none"></textarea>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="p-8 bg-gray-50/50 flex justify-end gap-3">
                    <template x-if="!isEdit">
                        <button type="button" @click="isEdit = true" class="px-6 py-2 bg-amber-500 text-white font-bold rounded-xl hover:bg-amber-600 transition shadow-lg shadow-amber-100 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Edit Data
                        </button>
                    </template>
                    <template x-if="isEdit">
                        <div class="flex gap-2">
                            <button type="button" @click="isEdit = false" class="px-6 py-2 bg-white border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-100 transition">Batal</button>
                            <button type="submit" class="px-6 py-2 bg-teal-600 text-white font-bold rounded-xl hover:bg-teal-700 transition">Simpan Perubahan</button>
                        </div>
                    </template>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(button) {
    const form = button.closest('.delete-form');
    Swal.fire({
        title: '<span class="font-black text-gray-900">Hapus Data?</span>',
        html: '<p class="text-sm text-gray-500 font-medium">Data kunjungan yang dihapus tidak dapat dikembalikan.</p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0d9488',
        cancelButtonColor: '#f3f4f6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: '<span class="text-gray-600">Batal</span>',
        reverseButtons: true,
        background: '#ffffff',
        customClass: {
            popup: 'rounded-[2.5rem] border border-gray-100 shadow-2xl',
            confirmButton: 'px-8 py-3 rounded-xl font-black shadow-lg shadow-teal-100',
            cancelButton: 'px-8 py-3 rounded-xl font-black'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    })
}

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: '<span class="font-black text-gray-900">Berhasil!</span>',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1500, // Dipercepat menjadi 1.5 detik
        background: '#ffffff',
        customClass: {
            popup: 'rounded-[2.5rem] border border-gray-100 shadow-xl'
        }
    });
@endif
</script>
@endsection