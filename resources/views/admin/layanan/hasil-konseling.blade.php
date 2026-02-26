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
                
                {{-- Alert Success --}}
                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: "{{ session('success') }}",
                            showConfirmButton: false,
                            timer: 2000,
                            customClass: { popup: 'rounded-[2rem]' }
                        });
                    </script>
                @endif

                {{-- FORM INPUT UTAMA --}}
                <div class="bg-white border border-gray-100 rounded-[2.5rem] shadow-sm p-8 mb-10">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center">
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
                            <button type="submit" class="px-10 py-4 bg-teal-600 text-white font-black rounded-2xl hover:bg-teal-700 transition-all duration-300">
                                Simpan Hasil Konseling
                            </button>
                        </div>
                    </form>
                </div>

                {{-- LIST DATA --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    @forelse($results as $res)
                        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-md transition group relative">
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 bg-teal-50 text-teal-600 rounded-lg text-[10px] font-black uppercase tracking-tighter italic">
                                    {{ $res->jenis_layanan }}
                                </span>
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                                    {{-- Tombol Edit --}}
                                    <button onclick="openEditModal({{ json_encode($res) }})" class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-100 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    {{-- Tombol Hapus --}}
                                    <button onclick="confirmDelete({{ $res->id }})" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <form id="delete-form-{{ $res->id }}" action="{{ route('admin.hasil-konseling.destroy', $res->id) }}" method="POST" class="hidden">
                                        @csrf @method('DELETE')
                                    </form>
                                </div>
                            </div>
                            
                            <h4 class="font-bold text-gray-900 mb-2">{{ $res->nama_siswa }}</h4>
                            <p class="text-sm text-gray-500 leading-relaxed italic line-clamp-3">"{{ $res->keterangan }}"</p>
                        </div>
                    @empty
                        <div class="md:col-span-2 text-center py-10 bg-gray-50 rounded-[2rem] border border-dashed">
                            <p class="text-gray-400 text-sm font-medium">Belum ada catatan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>
</div>

{{-- MODAL EDIT (TAILWIND CUSTOM) --}}
<div id="editModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 shadow-2xl">
    <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] p-8 shadow-2xl animate-in zoom-in duration-300">
        <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-3">
            <span class="w-8 h-8 bg-teal-50 text-teal-600 rounded-lg flex items-center justify-center italic text-sm">!</span>
            Edit Hasil Konseling
        </h3>
        
        <form id="editForm" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Nama Siswa</label>
                <input type="text" name="nama_siswa" id="edit_nama" required class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition">
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Jenis Layanan</label>
                <select name="jenis_layanan" id="edit_layanan" required class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition">
                    <option value="Konseling Pribadi">Konseling Pribadi</option>
                    <option value="Bimbingan Karir">Bimbingan Karir</option>
                    <option value="Konseling Belajar">Konseling Belajar</option>
                    <option value="Konseling Sosial">Konseling Sosial</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Keterangan</label>
                <textarea name="keterangan" id="edit_keterangan" rows="4" required class="w-full px-5 py-4 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:border-teal-500 outline-none transition"></textarea>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeEditModal()" class="flex-1 py-4 text-gray-400 font-bold hover:bg-gray-50 rounded-2xl transition">Batal</button>
                <button type="submit" class="flex-1 py-4 bg-teal-600 text-white font-black rounded-2xl hover:bg-teal-700 shadow-lg shadow-teal-100 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // FUNGSI MODAL EDIT
    function openEditModal(data) {
        const modal = document.getElementById('editModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        document.getElementById('edit_nama').value = data.nama_siswa;
        document.getElementById('edit_layanan').value = data.jenis_layanan;
        document.getElementById('edit_keterangan').value = data.keterangan;
        document.getElementById('editForm').action = `/admin/hasil-konseling/${data.id}`;
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // FUNGSI KONFIRMASI HAPUS (SweetAlert2)
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus Catatan?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d9488', // Teal 600
            cancelButtonColor: '#f3f4f6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-[2.5rem] p-8',
                confirmButton: 'rounded-xl px-6 py-3 font-bold',
                cancelButton: 'rounded-xl px-6 py-3 font-bold text-gray-500'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        })
    }
</script>
@endsection