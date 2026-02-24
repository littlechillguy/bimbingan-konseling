<x-app-layout>
    {{-- Container Utama --}}
    <div class="pt-32 md:pt-24 pb-24 px-4 sm:px-6 lg:px-8 min-h-screen bg-slate-50">
        <div class="max-w-4xl mx-auto">
            
            {{-- Tombol Kembali & Judul --}}
            <div class="mb-8 flex flex-col gap-4">
                <a href="{{ url()->previous() }}" class="group flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition-colors w-fit">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </div>
                    <span class="text-sm font-bold tracking-wide">Kembali</span>
                </a>
            </div>
            
            {{-- Form Card --}}
            <div class="bg-white rounded-[2.5rem] border border-slate-200/60 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="p-6 md:p-12">
                    <form action="#" method="POST" class="space-y-10">
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
                                    <select class="w-full px-6 py-4 bg-slate-50 border-slate-100 focus:border-emerald-500 focus:bg-white rounded-2xl focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none appearance-none font-medium text-slate-600">
                                        <option value="" disabled selected>Pilih kategori...</option>
                                        <option>Kesehatan Mental (Kecemasan, Stres, dll)</option>
                                        <option>Masalah Keluarga / Personal</option>
                                        <option>Kesulitan Belajar Berat</option>
                                        <option>Trauma / Pengalaman Buruk</option>
                                        <option>Lainnya</option>
                                    </select>
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-slate-700 ml-1">Tingkat Urgensi</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="urgency" class="peer sr-only">
                                            <div class="p-4 text-center bg-slate-50 rounded-2xl border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all font-bold text-slate-600 peer-checked:text-blue-700">
                                                Rendah
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="urgency" class="peer sr-only">
                                            <div class="p-4 text-center bg-slate-50 rounded-2xl border-2 border-transparent peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all font-bold text-slate-600 peer-checked:text-orange-700">
                                                Sedang
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="urgency" class="peer sr-only">
                                            <div class="p-4 text-center bg-slate-50 rounded-2xl border-2 border-transparent peer-checked:border-red-500 peer-checked:bg-red-50 transition-all font-bold text-slate-600 peer-checked:text-red-700">
                                                Darurat
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="border-slate-50">

                        {{-- Section 2: Detail --}}
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center font-black">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                                </div>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">Detail Keluhan</h3>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-700 ml-1">Apa yang ingin kamu sampaikan?</label>
                                <textarea rows="6" placeholder="Ceritakan situasi yang kamu alami secara jujur agar kami dapat memberikan bantuan terbaik..." 
                                    class="w-full px-6 py-4 bg-slate-50 border-slate-100 focus:border-emerald-500 focus:bg-white rounded-3xl focus:ring-4 focus:ring-emerald-500/10 transition-all outline-none resize-none"></textarea>
                            </div>
                            
                            <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 flex gap-3">
                                <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <p class="text-xs text-amber-800 font-medium leading-relaxed">
                                    <b>Privasi Terjamin:</b> Semua informasi yang kamu bagikan bersifat rahasia dan hanya akan diakses oleh konselor ahli yang bersangkutan sesuai dengan kode etik profesional.
                                </p>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-slate-900 hover:bg-emerald-600 text-white font-black py-5 rounded-[2rem] transition-all duration-500 transform active:scale-[0.98] flex items-center justify-center gap-3 shadow-xl shadow-emerald-900/10">
                                <span>Ajukan Jadwal Konsultasi</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Footer Info --}}
            <div class="mt-12 text-center">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                    Sistem Rujukan Konseling Ahli • SMKN 43 Jakarta<br>
                    <span class="text-emerald-500">Berlisensi & Profesional</span>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>