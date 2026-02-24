<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="font-black text-2xl text-gray-800 leading-tight tracking-tight">
                    {{ __('Halo, ') }} 
                    {{-- Menggunakan optional() atau null coalescing agar tidak error jika belum login --}}
                    <span class="text-teal-600">{{ auth()->user()->name ?? 'Siswa' }}!</span> 👋
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
                        <a href="{{ route('home') }}" class="flex items-center gap-4 p-6 bg-white/10 border border-white/10 rounded-3xl hover:bg-white hover:text-slate-900 transition-all group shadow-sm">
                            <div class="w-12 h-12 bg-teal-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-lg leading-tight">Konseling Online</p>
                                <p class="text-sm opacity-60">Via Chat & Video Call</p>
                            </div>
                        </a>

                        <a href="{{ route('home') }}" class="flex items-center gap-4 p-6 bg-white/10 border border-white/10 rounded-3xl hover:bg-white hover:text-slate-900 transition-all group shadow-sm">
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
            <div x-show="showChatMenu" x-cloak ...>
                </div>
            <button @click="showChatMenu = !showChatMenu" ...>
                </button>
        </div>
    </div>
</x-app-layout>