<x-app-layout>
    {{-- Container Utama --}}
    <div class="pt-32 md:pt-24 pb-24 px-4 sm:px-6 lg:px-8 min-h-screen bg-slate-50">
        <div class="max-w-4xl mx-auto">
            
            {{-- Tombol Kembali --}}
            <div class="mb-8 flex flex-col gap-4">
                <a href="{{ route('layanan') }}" class="group flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition-colors w-fit">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-bold tracking-wide">Kembali ke Layanan</span>
                </a>
            </div>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
            <div class="mb-8 p-6 bg-emerald-500 rounded-3xl text-white flex items-center gap-4 animate-in fade-in slide-in-from-top-4 duration-500 shadow-lg shadow-emerald-200">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
            @endif

            {{-- Form Card --}}
            <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-6 md:p-12">
                    <form action="{{ route('layanan.konseling.store') }}" method="POST" class="space-y-10">
                        @csrf
                        
                        {{-- Section 1: Topik Konsultasi --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center font-black">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">Informasi Konsultasi</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-slate-700 ml-1">Kategori Masalah</label>
                                    <select name="category" id="categorySelect" required class="w-full px-6 py-4 bg-slate-50 border-slate-100 focus:border-emerald-500 focus:bg-white rounded-2xl focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none appearance-none font-medium text-slate-600">
                                        <option value="" disabled selected>Pilih kategori...</option>
                                        <option value="Kesehatan Mental">Kesehatan Mental (Kecemasan, Stres, dll)</option>
                                        <option value="Kesehatan Fisik">Kesehatan Fisik</option>
                                        <option value="Masalah Keluarga">Masalah Keluarga / Personal</option>
                                        <option value="Kesulitan Belajar">Kesulitan Belajar Berat</option>
                                        <option value="Trauma">Trauma / Pengalaman Buruk</option>
                                        <option value="Rencana Karir">Rencana Karir</option>
                                        <option value="Lainnya">Lainnya (Tulis Sendiri)</option>
                                    </select>
                                    @error('category') <p class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Input Tambahan "Lainnya" --}}
                                <div id="otherCategoryWrapper" class="hidden space-y-2 animate-in slide-in-from-top-2 duration-300">
                                    <label class="block text-sm font-bold text-emerald-700 ml-1 italic">Sebutkan kategori masalah Anda:</label>
                                    <input type="text" name="other_category" id="otherCategoryInput" placeholder="Misal: Masalah Perundungan (Bullying)" 
                                        class="w-full px-6 py-4 bg-emerald-50/30 border-2 border-emerald-100 focus:border-emerald-500 focus:bg-white rounded-2xl outline-none transition-all font-medium text-slate-700">
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-slate-700 ml-1">Tingkat Urgensi</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="urgency" value="rendah" required class="peer sr-only">
                                            <div class="p-4 text-center bg-slate-50 rounded-2xl border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all font-bold text-slate-600 peer-checked:text-blue-700">
                                                Rendah
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="urgency" value="sedang" class="peer sr-only">
                                            <div class="p-4 text-center bg-slate-50 rounded-2xl border-2 border-transparent peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all font-bold text-slate-600 peer-checked:text-orange-700">
                                                Sedang
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="urgency" value="darurat" class="peer sr-only">
                                            <div class="p-4 text-center bg-slate-50 rounded-2xl border-2 border-transparent peer-checked:border-red-500 peer-checked:bg-red-50 transition-all font-bold text-slate-600 peer-checked:text-red-700">
                                                Darurat
                                            </div>
                                        </label>
                                    </div>
                                    @error('urgency') <p class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-50">

                        {{-- Section 2: Kontak Siswa --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center font-black">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">Informasi Kontak</h3>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Nomor WhatsApp Aktif</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                                        <span class="font-bold text-lg">+62</span>
                                    </div>
                                    <input type="tel" name="whatsapp" required placeholder="81234567890" value="{{ old('whatsapp') }}"
                                        class="w-full pl-20 pr-6 py-4 bg-slate-50 border-slate-100 focus:border-emerald-500 focus:bg-white rounded-2xl focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none font-bold text-slate-700 tracking-wider">
                                </div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider ml-1">Hanya angka saja (Contoh: 812...)</p>
                                @error('whatsapp') <p class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <hr class="border-slate-50">

                        {{-- Section 3: Detail --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center font-black">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">Detail Keluhan</h3>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Apa yang ingin kamu sampaikan?</label>
                                <textarea name="message" required rows="6" placeholder="Ceritakan situasi yang kamu alami secara jujur agar kami dapat memberikan bantuan terbaik..." 
                                    class="w-full px-6 py-4 bg-slate-50 border-slate-100 focus:border-emerald-500 focus:bg-white rounded-3xl focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none resize-none font-medium">{{ old('message') }}</textarea>
                                @error('message') <p class="text-red-500 text-xs font-bold mt-1 ml-1">{{ $message }}</p> @enderror
                            </div>
                            
                            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 flex gap-3">
                                <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs text-amber-800 font-medium leading-relaxed">
                                    <b>Privasi Terjamin:</b> Semua informasi bersifat rahasia dan hanya digunakan untuk kepentingan bimbingan konseling SMKN 43 Jakarta.
                                </p>
                            </div>
                        </div>

                        {{-- Tombol Submit --}}
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-black py-5 rounded-[2rem] transition-all duration-500 transform active:scale-[0.98] flex items-center justify-center gap-3 shadow-xl shadow-emerald-900/10 group">
                                <span>Kirim Permohonan Konseling</span>
                                <svg class="w-6 h-6 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-12 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                    Sistem Rujukan Konseling Ahli • SMKN 43 Jakarta<br>
                    <span class="text-slate-300">BK SMKN 43 Jakarta</span>
                </p>
            </div>
        </div>
    </div>

    {{-- Script Interaktif untuk Kategori Lainnya --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorySelect');
            const otherWrapper = document.getElementById('otherCategoryWrapper');
            const otherInput = document.getElementById('otherCategoryInput');

            categorySelect.addEventListener('change', function() {
                if (this.value === 'Lainnya') {
                    // Tampilkan input tambahan
                    otherWrapper.classList.remove('hidden');
                    otherInput.setAttribute('required', 'required');
                    otherInput.focus();
                } else {
                    // Sembunyikan dan hapus required agar tidak mengganggu validasi
                    otherWrapper.classList.add('hidden');
                    otherInput.removeAttribute('required');
                    otherInput.value = '';
                }
            });
        });
    </script>
</x-app-layout>