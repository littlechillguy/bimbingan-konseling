<x-app-layout>
    <x-slot name="header">
        {{-- Menambahkan pt-16 atau pt-20 jika header ini juga tertutup navbar --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Halo, ') }} <span class="text-teal-600">{{ Auth::user()->name }}!</span> 👋
                </h2>
                <p class="text-sm text-gray-500 font-medium">Apa yang bisa kami bantu hari ini?</p>
            </div>
            <div class="hidden md:block">
                <span class="px-4 py-2 bg-teal-50 text-teal-700 rounded-full text-xs font-bold border border-teal-100">
                    Siswa Aktif • SMKN 43 Jakarta
                </span>
            </div>
        </div>
    </x-slot>

    {{-- Gunakan mt-20 atau pt-20 untuk memberi jarak aman dari navbar yang fixed --}}
    <div class="pt-24 pb-12 px-4" x-data="{ showChatMenu: false }">
        <div class="max-w-7xl mx-auto space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('layanan.chat-anonim') }}" class="group relative overflow-hidden bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-teal-500/10 transition-all duration-300 active:scale-95">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-teal-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-teal-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-teal-200">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Chat Anonim</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Curahkan perasaanmu tanpa perlu takut identitas diketahui.</p>
                        <div class="mt-4 flex items-center text-teal-600 font-bold text-xs uppercase tracking-wider">
                            Mulai Chat <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('layanan.karir') }}" class="group relative overflow-hidden bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 active:scale-95">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-200">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Bimbingan Karir</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Konsultasi mengenai minat, bakat, dan masa depanmu.</p>
                        <div class="mt-4 flex items-center text-blue-600 font-bold text-xs uppercase tracking-wider">
                            Eksplorasi <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('layanan.pribadi') }}" class="group relative overflow-hidden bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-300 active:scale-95">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-rose-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-rose-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-rose-200">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Konseling Pribadi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">Bicarakan masalah pribadi atau sosial dengan guru BK.</p>
                        <div class="mt-4 flex items-center text-rose-600 font-bold text-xs uppercase tracking-wider">
                            Mulai Konseling <svg class="ml-2 w-4 h-4 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </div>
                    </div>
                </a>
            </div>

            <div class="bg-slate-900 rounded-[3rem] p-8 md:p-12 text-white overflow-hidden relative shadow-2xl">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                </div>
                
                <div class="relative z-10">
                    <h3 class="text-2xl md:text-3xl font-black mb-4 tracking-tight">Pilih Metode Konseling</h3>
                    <p class="text-slate-400 mb-8 max-w-lg font-medium">Sampaikan masalahmu dengan cara yang paling membuatmu nyaman.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('layanan.online') }}" class="flex items-center gap-4 p-6 bg-white/10 border border-white/10 rounded-3xl hover:bg-white hover:text-slate-900 transition-all group shadow-sm">
                            <div class="w-12 h-12 bg-teal-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-lg leading-tight">Konseling Online</p>
                                <p class="text-sm opacity-60">Via Chat & Video Call</p>
                            </div>
                        </a>

                        <a href="{{ route('layanan.offline') }}" class="flex items-center gap-4 p-6 bg-white/10 border border-white/10 rounded-3xl hover:bg-white hover:text-slate-900 transition-all group shadow-sm">
                            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-lg leading-tight">Konseling Offline</p>
                                <p class="text-sm opacity-60">Bertemu di Ruang BK</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-3">
            <div x-show="showChatMenu" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-10 scale-90"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-10 scale-90"
                 class="bg-white p-4 rounded-[2rem] shadow-2xl border border-gray-100 w-64 mb-2">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 px-2 text-center">Chat Guru BK</p>
                <div class="space-y-2">
                    <a href="https://wa.me/6283894541627" target="_blank" class="flex items-center gap-3 p-3 hover:bg-teal-50 rounded-2xl transition-all group border border-transparent hover:border-teal-100">
                        <img src="https://ui-avatars.com/api/?name=Ibu+Sari&background=0D9488&color=fff" class="w-10 h-10 rounded-full" alt="">
                        <div>
                            <p class="text-sm font-bold text-gray-800">Ibu Sari, S.Pd</p>
                        </div>
                    </a>
                    <a href="https://wa.me/628987654321" target="_blank" class="flex items-center gap-3 p-3 hover:bg-blue-50 rounded-2xl transition-all group border border-transparent hover:border-blue-100">
                        <img src="https://ui-avatars.com/api/?name=Pak+Budi&background=2563EB&color=fff" class="w-10 h-10 rounded-full" alt="">
                        <div>
                            <p class="text-sm font-bold text-gray-800">Pak Budi, S.Psi</p>                        </div>
                    </a>
                </div>
            </div>

            <button @click="showChatMenu = !showChatMenu" 
                    class="w-16 h-16 bg-[#25D366] text-white rounded-full shadow-xl shadow-green-200 flex items-center justify-center hover:scale-110 active:scale-90 transition-all duration-300 relative group">
                <span class="absolute -top-1 -right-1 flex h-5 w-5" x-show="!showChatMenu">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-5 w-5 bg-green-500 border-2 border-white"></span>
                </span>
                <svg x-show="!showChatMenu" class="w-8 h-8 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.888 11.888-11.888 3.176 0 6.161 1.237 8.404 3.48s3.481 5.229 3.481 8.406c0 6.556-5.333 11.888-11.889 11.888-2.013 0-3.987-.511-5.741-1.483l-6.142 1.611zm6.109-3.277l.439.26c1.604.953 3.446 1.456 5.34 1.456 5.735 0 10.403-4.668 10.403-10.403s-4.668-10.403-10.403-10.403-10.403 4.668-10.403 10.403c0 2.112.631 4.135 1.82 5.855l.286.413-1.002 3.659 3.757-.985zm10.613-7.583c-.3-.15-1.771-.875-2.046-.975-.275-.1-.475-.15-.675.15-.2.3-.775 1.012-.95 1.212-.175.2-.35.225-.65.075-.3-.15-1.263-.463-2.403-1.48-1.129-1.007-1.888-2.251-2.113-2.625-.225-.375-.025-.575.125-.725.137-.137.3-.35.45-.525.15-.175.2-.3.3-.5.1-.2.05-.375-.025-.525-.075-.15-.675-1.625-.925-2.225-.244-.588-.491-.508-.675-.517-.175-.008-.375-.01-.575-.01s-.525.075-.8.375c-.275.3-1.05 1.025-1.05 2.5s1.075 2.925 1.225 3.125c.15.2 2.113 3.226 5.118 4.525.714.31 1.272.495 1.706.632.715.226 1.365.195 1.88.118.573-.085 1.771-.725 2.021-1.425.25-.7.25-1.3.175-1.425-.075-.125-.275-.2-.575-.35z"/></svg>
                <svg x-show="showChatMenu" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    {{-- Script ditempatkan di akhir body atau via @push jika layout mendukung --}}
    @push('scripts')
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush
</x-app-layout>