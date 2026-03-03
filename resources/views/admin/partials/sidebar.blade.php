<div x-data="{ sidebarOpen: false }">
    {{-- 1. TOMBOL BURGER --}}
    <div class="lg:hidden fixed top-4 left-4 z-[100]">
        <button @click="sidebarOpen = !sidebarOpen" 
            class="p-3 bg-white border border-gray-100 shadow-xl rounded-2xl text-teal-600 focus:outline-none active:scale-95 transition-all">
            <svg x-show="!sidebarOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="sidebarOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- 2. BACKDROP --}}
    <div x-show="sidebarOpen" 
        x-transition:opacity
        x-cloak
        @click="sidebarOpen = false" 
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-80 lg:hidden">
    </div>

    {{-- 3. SIDEBAR --}}
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        {{-- Penjelasan: flex-col + justify-between memaksa logout section ke bawah --}}
        class="fixed lg:sticky top-0 left-0 z-[90] w-64 bg-white border-r border-gray-100 flex flex-col h-screen transition-transform duration-300 ease-in-out shadow-2xl lg:shadow-none justify-between">
        
        {{-- Bagian Atas (Branding + Navigasi) --}}
        <div class="flex flex-col flex-1 overflow-hidden">
            {{-- Branding Section: pt-20 di mobile agar turun di bawah burger --}}
            <div class="flex items-center gap-3 px-10 pt-20 lg:pt-8 mb-8 flex-shrink-0">
                <div class="relative">
                    <img src="{{ asset('asset/logo43.png') }}" class="w-12 h-12 object-contain" alt="Logo">
                    <span class="absolute -top-1 -right-1 flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-teal-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-500"></span>
                    </span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[14px] font-black text-slate-900 leading-tight uppercase">
                        Bimbingan<br>
                        <span class="text-teal-600">Konseling</span>
                    </span>
                    <span class="text-[8px] font-bold text-slate-400 tracking-widest uppercase mt-0.5">SMKN 43 Jakarta</span>
                </div>
            </div>

            {{-- Navigasi (Hanya bagian ini yang scrollable) --}}
            <nav class="flex-1 overflow-y-auto px-6 space-y-1 custom-scrollbar pb-6">
                <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Main Menu</p>
                
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    <span class="text-sm">Dashboard</span>
                </a>

                <a href="{{ route('admin.jadwal') }}" 
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.jadwal') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-sm">Jadwal Masuk</span>
                </a>

                <a href="{{ route('admin.siswa') }}" 
                    class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.siswa*') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span class="text-sm">Data Siswa</span>
                </a>

                <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mt-8 mb-4">Layanan BK</p>
                
                @php $hasNewChat = true; @endphp
                <a href="{{ route('admin.chat') }}" 
                    class="relative flex items-center space-x-3 p-3 {{ request()->routeIs('admin.chat') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <div class="relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                        @if($hasNewChat)
                        <span class="absolute -top-1 -right-1 flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                        </span>
                        @endif
                    </div>
                    <span class="text-sm">Chat Anonim</span>
                    @if($hasNewChat)
                        <span class="ml-auto bg-red-500 text-white text-[9px] px-2 py-0.5 rounded-full animate-bounce">NEW</span>
                    @endif
                </a>

                <a href="{{ route('admin.hasil-konseling') }}" class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.hasil-konseling') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span class="text-sm">Hasil Konseling</span>
                </a>

                <a href="{{ route('admin.layanan.tindak-lanjut') }}" class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.layanan.tindak-lanjut') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                    <span class="text-sm">Tindak Lanjut</span>
                </a>

                <a href="{{ route('admin.home-visit') }}" class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.home-visit') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span class="text-sm">Home Visit</span>
                </a>

                <a href="{{ route('admin.minat-karir') }}" class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.minat-karir') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span class="text-sm">Minat Karir</span>
                </a>
            </nav>
        </div>

        {{-- Logout Section (Terpisah di paling bawah) --}}
        <div class="flex-shrink-0 p-6 border-t border-gray-100 bg-white">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition w-full group">
                    <div class="p-2 bg-red-50 group-hover:bg-red-100 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="text-sm">Keluar</span>
                </button>
            </form>
        </div>
    </aside>
</div>