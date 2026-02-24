<x-app-layout>
    <x-slot name="header">
        <div class="mt-16 md:mt-24 flex flex-col md:flex-row md:items-center md:justify-between gap-6 py-4">
        </div>
    </x-slot>

    {{-- Container Utama --}}
    <div class="pt-28 md:pt-24 pb-24 px-4 sm:px-6 lg:px-8 bg-[#FBFBFB]" x-data="{ showChatMenu: false, activeTab: 'semua' }">
        <div class="max-w-7xl mx-auto space-y-16">

            {{-- Header & Filter Singkat --}}
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6 tracking-tight">Pusat Layanan <span class="text-teal-600">Bimbingan Konseling</span></h1>
                <p class="text-gray-500 font-medium leading-relaxed">Pilih layanan yang sesuai dengan kebutuhanmu. Privasimu adalah prioritas utama kami.</p>
            </div>

            {{-- Section: Utama (Box Fitur) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                {{-- Card 1: Chat Anonim --}}
                <a href="{{ route('layanan.chat-anonim') }}" class="group relative bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:shadow-teal-500/10 transition-all duration-500 active:scale-[0.98] overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity duration-500 text-teal-900">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-teal-50 text-teal-600 rounded-[1.5rem] flex items-center justify-center mb-8 group-hover:bg-teal-600 group-hover:text-white transition-all duration-500 rotate-3 group-hover:rotate-0 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-3 tracking-tight">Chat Anonim</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">Curahkan perasaanmu tanpa perlu takut identitas diketahui oleh siapapun.</p>
                        <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between text-teal-600 font-black text-[10px] uppercase tracking-[0.2em]">
                            <span>Mulai Sesi</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Card 2: Karir --}}
                <a href="{{ route('layanan.karir') }}" class="group relative bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 active:scale-[0.98] overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity duration-500 text-blue-900">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-[1.5rem] flex items-center justify-center mb-8 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 -rotate-3 group-hover:rotate-0 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-3 tracking-tight">Eksplorasi Karir</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">Petakan masa depanmu berdasarkan minat dan bakat unik yang kamu miliki.</p>
                        <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between text-blue-600 font-black text-[10px] uppercase tracking-[0.2em]">
                            <span>Cek Potensi</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                {{-- Card 3: Konseling --}}
                <a href="{{ route('layanan.konseling') }}" class="group relative bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:shadow-rose-500/10 transition-all duration-500 active:scale-[0.98] overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.08] transition-opacity duration-500 text-rose-900">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-[1.5rem] flex items-center justify-center mb-8 group-hover:bg-rose-600 group-hover:text-white transition-all duration-500 rotate-6 group-hover:rotate-0 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-3 tracking-tight">Konseling Ahli</h3>
                        <p class="text-gray-500 text-sm leading-relaxed font-medium">Bicarakan masalah pribadi atau sosial dengan guru BK secara mendalam.</p>
                        <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between text-rose-600 font-black text-[10px] uppercase tracking-[0.2em]">
                            <span>Atur Jadwal</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Section: Stats & Progress --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                    <span class="text-3xl mb-2">🤝</span>
                    <h5 class="text-xl font-black text-gray-900">100%</h5>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest">Kerahasiaan</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                    <span class="text-3xl mb-2">⚡</span>
                    <h5 class="text-xl font-black text-gray-900">Fast</h5>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest">Respon Cepat</p>
                </div>

                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                    <span class="text-3xl mb-2">👩‍🏫</span>
                    <h5 class="text-xl font-black text-gray-900">Ahli</h5>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest">Guru Kompeten</p>
                </div>

                {{-- Ikon Baru untuk FREE --}}
                <div class="bg-white p-8 rounded-[2rem] border border-gray-100 flex flex-col items-center text-center hover:shadow-lg transition-shadow duration-300">
                    <span class="text-3xl mb-2">🎁</span>
                    <h5 class="text-xl font-black text-gray-900">Free</h5>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest">Tanpa Biaya</p>
                </div>
            </div>
            {{-- Info Quote Section --}}
            <div class="bg-gray-900 rounded-[3rem] p-10 md:p-16 relative overflow-hidden shadow-2xl shadow-gray-200">
                <div class="absolute top-0 right-0 w-64 h-64 bg-teal-500/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="relative z-10 max-w-2xl">
                    <h4 class="text-teal-400 font-black text-xs uppercase tracking-[0.4em] mb-6">Mental Health Matters</h4>
                    <p class="text-white text-2xl md:text-3xl font-bold leading-tight mb-8">
                        "Setiap perasaan itu valid. <span class="text-gray-400">Jangan simpan sendirian, kami ada untuk mendengarkan."</span>
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="h-[1px] w-12 bg-teal-500"></div>
                        <span class="text-gray-500 text-xs font-bold uppercase tracking-widest">Team BK SMKN 43 Jakarta</span>
                    </div>
                </div>
            </div>

            {{-- New Section: FAQ Sederhana --}}
            <div class="space-y-8">
                <h3 class="text-2xl font-black text-gray-900 text-center">Sering Ditanyakan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-8 rounded-[2rem] border border-gray-100">
                        <h6 class="font-bold text-gray-900 mb-2 italic">"Apakah guru tahu siapa yang mengirim chat anonim?"</h6>
                        <p class="text-sm text-gray-500 leading-relaxed">Tidak. Sistem kami mengenkripsi identitasmu sehingga yang muncul di layar guru hanyalah nama samaran (Anonymous).</p>
                    </div>
                    <div class="bg-white p-8 rounded-[2rem] border border-gray-100">
                        <h6 class="font-bold text-gray-900 mb-2 italic">"Kapan waktu terbaik untuk konseling?"</h6>
                        <p class="text-sm text-gray-500 leading-relaxed">Kapanpun kamu merasa butuh teman bicara. Namun untuk tatap muka, pastikan sudah membuat janji melalui menu Konseling Ahli.</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Floating Action Menu (Tetap sama, hanya penyesuaian warna dikit) --}}
        @auth
        <div class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-[9999] flex flex-col items-end gap-3">
            <div x-show="showChatMenu"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                class="flex flex-col items-end gap-3 mb-2"
                style="display: none;">

                <a href="https://wa.me/6281234567890" target="_blank" class="bg-white hover:bg-emerald-50 text-gray-900 px-6 py-4 rounded-2xl shadow-2xl border border-emerald-100 flex items-center gap-3 transition-all active:scale-95 group">
                    <div class="flex flex-col items-end">
                        <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Hubungi Guru BK</span>
                        <span class="text-sm font-bold">Ibu Sari, S.Pd</span>
                    </div>
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center group-hover:rotate-12 transition-transform">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.29-4.143c1.589.943 3.385 1.44 5.215 1.441 5.44 0 9.865-4.427 9.867-9.867 0-2.639-1.027-5.119-2.892-6.984-1.866-1.864-4.346-2.891-6.985-2.891-5.439 0-9.865 4.426-9.867 9.867 0 1.935.569 3.83 1.65 5.448l-.997 3.642 3.732-.979zm11.486-6.44c-.33-.165-1.954-.964-2.254-1.074-.3-.109-.518-.165-.735.165-.218.329-.844 1.073-1.034 1.293-.19.22-.381.247-.711.082-.33-.165-1.393-.513-2.653-1.638-1-.891-1.676-1.991-1.873-2.33-.197-.34-.021-.523.144-.686.148-.147.33-.384.495-.577.165-.192.22-.33.33-.55.11-.22.055-.412-.028-.577-.082-.165-.735-1.772-1.007-2.43-.265-.64-.537-.554-.735-.563-.189-.01-.407-.012-.626-.012-.218 0-.571.082-.871.412-.3.33-1.144 1.118-1.144 2.724 0 1.606 1.171 3.159 1.334 3.379.163.22 2.304 3.518 5.582 4.937.78.337 1.39.538 1.86.687.784.248 1.498.213 2.062.128.629-.094 1.954-.797 2.227-1.567.272-.769.272-1.428.191-1.567-.082-.14-.299-.22-.629-.385z" />
                        </svg>
                    </div>
                </a>
            </div>

            <button @click="showChatMenu = !showChatMenu"
                :class="showChatMenu ? 'bg-rose-500 rotate-90 shadow-rose-200' : 'bg-emerald-500 shadow-emerald-200'"
                class="w-16 h-16 text-white rounded-[2rem] shadow-2xl flex items-center justify-center transition-all duration-300 active:scale-90 focus:outline-none ring-4 ring-white">
                <svg x-show="!showChatMenu" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.883 1.026 4.009 1.564 6.163 1.565 6.555 0 11.89-5.335 11.893-11.893a11.826 11.826 0 00-3.48-8.413Z" />
                </svg>
                <svg x-show="showChatMenu" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @endauth
    </div>
</x-app-layout>