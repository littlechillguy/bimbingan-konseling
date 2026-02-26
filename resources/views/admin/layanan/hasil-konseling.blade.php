@extends('layouts.app')

@section('title', 'Hasil Konseling - SMKN 43 JAKARTA')
@section('page_title', 'Layanan BK / Hasil Konseling')

@section('content')
{{-- Load SweetAlert2 & AlpineJS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen bg-[#FBFBFB] flex overflow-hidden" x-data="{ showData: true }"> 
    @include('admin.partials.sidebar')

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        @include('admin.partials.navbar')

        <main class="flex-1 overflow-y-auto p-6 lg:p-10">
            <div class="max-w-5xl mx-auto w-full">
                
                {{-- FORM INPUT --}}
                <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm p-10 mb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-gray-900">Catat Hasil Konseling</h3>
                            <p class="text-sm text-gray-400 font-medium">Dokumentasikan sesi bimbingan siswa hari ini.</p>
                        </div>
                    </div>

                    {{-- Ditambahkan onsubmit="return validateForm(this)" --}}
                    <form action="{{ route('admin.hasil-konseling.store') }}" method="POST" onsubmit="return validateForm(this)" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 ml-1 uppercase tracking-widest">Nama Lengkap Siswa</label>
                                <input type="text" name="nama_siswa" id="nama_siswa" required placeholder="Contoh: Budi Santoso" 
                                    class="w-full px-5 py-4 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition shadow-sm text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-gray-400 ml-1 uppercase tracking-widest">Kategori Layanan</label>
                                <div class="relative">
                                    <select name="jenis_layanan" required 
                                        class="w-full px-5 py-4 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition shadow-sm text-sm appearance-none">
                                        <option value="Konseling Pribadi">Konseling Pribadi</option>
                                        <option value="Bimbingan Karir">Bimbingan Karir</option>
                                        <option value="Konseling Belajar">Konseling Belajar</option>
                                        <option value="Konseling Sosial">Konseling Sosial</option>
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-gray-400 ml-1 uppercase tracking-widest">Hasil Akhir & Rekomendasi</label>
                            <textarea name="keterangan" id="keterangan" rows="4" required placeholder="Tuliskan poin-poin hasil konseling secara mendetail..." 
                                class="w-full px-5 py-4 bg-gray-50 border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition shadow-sm text-sm"></textarea>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="px-10 py-4 bg-teal-600 text-white font-black rounded-2xl hover:bg-teal-700 transition shadow-lg shadow-teal-100 uppercase text-xs tracking-widest">
                                Simpan Laporan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- DIVIDER DENGAN TOMBOL HIDE/SHOW --}}
                <div class="relative flex items-center justify-center mb-10">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-100"></div>
                    </div>
                    <button @click="showData = !showData" 
                        class="relative z-10 flex items-center gap-2 px-6 py-2 bg-white border border-gray-100 rounded-full shadow-sm hover:bg-gray-50 transition group">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]" 
                              x-text="showData ? 'Sembunyikan Riwayat' : 'Tampilkan Riwayat'"></span>
                        <svg class="w-3 h-3 text-gray-400 group-hover:text-teal-500 transition-transform" 
                             :class="showData ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                {{-- TABEL DATA --}}
                <div x-show="showData" class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm overflow-hidden mb-20">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50 border-b border-gray-100">
                                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Siswa</th>
                                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($results as $res)
                                <tr class="hover:bg-teal-50/20 transition-all group">
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <p class="text-[11px] font-bold text-gray-400">{{ $res->created_at->format('d M Y') }}</p>
                                        <p class="text-[10px] text-gray-300">{{ $res->created_at->format('H:i') }} WIB</p>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full bg-teal-400"></div>
                                            <p class="text-sm font-black text-gray-800">{{ $res->nama_siswa }}</p>
                                            <span class="text-[9px] font-black px-2 py-0.5 bg-gray-100 text-gray-400 rounded-md uppercase tracking-tighter">
                                                {{ $res->jenis_layanan }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <button onclick='openViewModal(@json($res))' class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-teal-600 hover:bg-white rounded-xl shadow-none hover:shadow-sm transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                            </button>
                                            <button onclick="confirmDelete('{{ $res->id }}')" class="w-8 h-8 flex items-center justify-center text-gray-300 hover:text-red-500 hover:bg-white rounded-xl shadow-none hover:shadow-sm transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                            <form id="delete-form-{{ $res->id }}" action="{{ route('admin.hasil-konseling.destroy', $res->id) }}" method="POST" class="hidden">
                                                @csrf @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="py-12 text-center text-gray-400 text-xs font-medium italic">Data riwayat belum tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

{{-- MODAL VIEW DETAIL --}}
<div id="viewModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-md" onclick="closeViewModal()"></div>
    <div class="relative bg-white w-full max-w-lg rounded-[3rem] p-10 shadow-2xl">
        <div class="mb-8">
            <span id="view_layanan" class="px-4 py-1.5 bg-teal-50 text-teal-600 rounded-full text-[10px] font-black uppercase tracking-widest"></span>
            <h3 id="view_nama" class="text-2xl font-black text-gray-900 mt-4"></h3>
            <p id="view_tanggal" class="text-xs text-gray-400 font-bold mt-1 uppercase"></p>
        </div>
        <div class="bg-gray-50 rounded-[2rem] p-8 mb-8">
            <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-4">Ringkasan Hasil:</p>
            <p id="view_keterangan" class="text-gray-700 leading-relaxed text-sm italic"></p>
        </div>
        <button onclick="closeViewModal()" class="w-full py-4 bg-gray-900 text-white font-black rounded-2xl hover:bg-black transition shadow-xl">Tutup</button>
    </div>
</div>

<script>
    // FUNGSI VALIDASI BARU
    function validateForm(form) {
        const nama = form.nama_siswa.value.trim();
        const keterangan = form.keterangan.value.trim();

        if (nama.length <= 4 || keterangan.length <= 4) {
            Swal.fire({
                icon: 'error',
                title: 'Input Terlalu Pendek',
                text: 'Nama dan Keterangan harus diisi lebih dari 4 karakter agar data lebih akurat.',
                confirmButtonColor: '#0d9488',
                customClass: {
                    popup: 'rounded-[2rem]',
                    confirmButton: 'rounded-xl px-6 py-3 font-bold uppercase text-xs tracking-widest'
                }
            });
            return false; // Mencegah form dikirim
        }
        return true; // Form dikirim jika valid
    }

    function openViewModal(data) {
        document.getElementById('viewModal').classList.replace('hidden', 'flex');
        document.getElementById('view_nama').innerText = data.nama_siswa;
        document.getElementById('view_layanan').innerText = data.jenis_layanan;
        document.getElementById('view_keterangan').innerText = data.keterangan;
        document.getElementById('view_tanggal').innerText = new Date(data.created_at).toLocaleDateString('id-ID', { day:'numeric', month:'long', year:'numeric' });
    }
    
    function closeViewModal() { document.getElementById('viewModal').classList.replace('flex', 'hidden'); }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Tindakan ini tidak dapat dibatalkan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d9488',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-[2.5rem]' }
        }).then((result) => { if (result.isConfirmed) document.getElementById('delete-form-' + id).submit(); });
    }
</script>
@endsection