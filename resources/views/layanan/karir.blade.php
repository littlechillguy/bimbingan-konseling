<x-app-layout>
    <div class="pt-32 md:pt-24 pb-24 px-4 sm:px-6 lg:px-8 min-h-screen bg-gray-50/50">
        <div class="max-w-4xl mx-auto">

            {{-- Alert Success --}}
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-2xl font-bold">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="mb-8 flex flex-col gap-4">
                <a href="{{ url()->previous() }}" class="group flex items-center gap-2 text-gray-500 hover:text-blue-600 transition-colors w-fit">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center shadow-sm group-hover:bg-blue-50 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    </div>
                    <span class="text-sm font-bold tracking-wide">Kembali ke Layanan</span>
                </a>
            </div>
            
            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden transition-all duration-300">
                <div class="p-6 md:p-12">
                    {{-- UPDATE ACTION DISINI --}}
                    <form action="{{ route('layanan.karir.store') }}" method="POST" class="space-y-10">
                        @csrf
                        
                        <div class="space-y-6">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-black shadow-sm">01</div>
                                <h3 class="text-xl font-black text-gray-900 tracking-tight">Apa yang kamu sukai?</h3>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-gray-700 ml-1">Hobi atau Kegemaran</label>
                                    {{-- TAMBAHKAN NAME="hobi" --}}
                                    <input type="text" name="hobi" required placeholder="Contoh: Coding, Menggambar" 
                                        class="w-full px-6 py-4 bg-gray-50 border-gray-100 focus:border-blue-500 focus:bg-white rounded-2xl focus:ring-4 focus:ring-blue-500/10 transition-all outline-none">
                                </div>
                                <div class="space-y-2">
                                    <label class="block text-sm font-bold text-gray-700 ml-1">Pelajaran Favorit</label>
                                    {{-- TAMBAHKAN NAME="pelajaran_favorit" --}}
                                    <select name="pelajaran_favorit" required class="w-full px-6 py-4 bg-gray-50 border-gray-100 focus:border-blue-500 focus:bg-white rounded-2xl focus:ring-4 focus:ring-blue-500/10 transition-all outline-none appearance-none">
                                        <option value="" disabled selected>Pilih pelajaran...</option>
                                        <option value="Matematika / Logika">Matematika / Logika</option>
                                        <option value="Seni / Desain">Seni / Desain</option>
                                        <option value="Bahasa / Komunikasi">Bahasa / Komunikasi</option>
                                        <option value="Olahraga / Fisik">Olahraga / Fisik</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-50">

                        <div class="space-y-6">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black shadow-sm">02</div>
                                <h3 class="text-xl font-black text-gray-900 tracking-tight">Kekuatan & Lingkungan</h3>
                            </div>

                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Bagaimana cara kamu bekerja?</label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    {{-- TAMBAHKAN NAME="work_style" DAN VALUE --}}
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="work_style" value="Individu" class="peer sr-only" required>
                                        <div class="p-4 text-center bg-gray-50 rounded-2xl border-2 border-transparent peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all font-bold text-gray-600 peer-checked:text-indigo-700 group-hover:bg-gray-100">
                                            Individu
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="work_style" value="Tim" class="peer sr-only">
                                        <div class="p-4 text-center bg-gray-50 rounded-2xl border-2 border-transparent peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all font-bold text-gray-600 peer-checked:text-indigo-700 group-hover:bg-gray-100">
                                            Tim
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="work_style" value="Fleksibel" class="peer sr-only">
                                        <div class="p-4 text-center bg-gray-50 rounded-2xl border-2 border-transparent peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all font-bold text-gray-600 peer-checked:text-indigo-700 group-hover:bg-gray-100">
                                            Fleksibel
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="pt-4 space-y-2">
                                <label class="block text-sm font-bold text-gray-700 ml-1">Cita-cita & Keluhan</label>
                                {{-- TAMBAHKAN NAME="cita_cita_keluhan" --}}
                                <textarea name="cita_cita_keluhan" required rows="5" placeholder="Ceritakan impianmu..." 
                                    class="w-full px-6 py-4 bg-gray-50 border-gray-100 focus:border-indigo-500 focus:bg-white rounded-3xl focus:ring-4 focus:ring-indigo-500/10 transition-all outline-none resize-none"></textarea>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full bg-gray-900 hover:bg-blue-600 text-white font-black py-5 rounded-[2rem] transition-all duration-500 transform active:scale-[0.98] flex items-center justify-center gap-3 shadow-xl shadow-blue-900/10">
                                <span>Kirim Data Karir</span>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>