<aside class="w-64 bg-white border-r border-gray-100 hidden lg:flex flex-col sticky top-0 h-screen pt-8 pb-10 px-6">
    <div class="flex items-center gap-3 px-4 mb-10">
        <img src="{{ asset('asset/logo43.png') }}" class="w-10 h-10" alt="Logo">
        <span class="text-xl font-black text-gray-900 tracking-tight">SMKN <span class="text-teal-600">43 JAKARTA</span></span>
    </div>

    <nav class="space-y-1 flex-1 overflow-y-auto custom-scrollbar">
        <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Main Menu</p>
        
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
            </svg>
            <span class="text-sm">Dashboard</span>
        </a>

        <a href="#" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm">Jadwal Masuk</span>
        </a>

        <p class="px-4 text-[10px] font-black text-gray-400 uppercase tracking-widest mt-6 mb-2">Layanan BK</p>
        
        <a href="{{ route('admin.chat') }}" 
            class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.chat') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            <span class="text-sm">Chat Anonim</span>
        </a>

        {{-- Link Hasil Konseling (Disesuaikan jika sudah ada route-nya) --}}
        <a href="#" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="text-sm">Hasil Konseling</span>
        </a>

        <a href="#" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl font-semibold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path>
            </svg>
            <span class="text-sm">Tindak Lanjut</span>
        </a>

        <a href="{{ route('admin.home-visit') }}" 
            class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.home-visit') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span class="text-sm">Home Visit</span>
        </a>

        <a href="{{ route('admin.minat-karir') }}" 
            class="flex items-center space-x-3 p-3 {{ request()->routeIs('admin.minat-karir') ? 'bg-teal-50 text-teal-600' : 'text-gray-500 hover:bg-gray-50' }} rounded-xl font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
            <span class="text-sm">Minat Karir</span>
        </a>
    </nav>

    <div class="border-t border-gray-100 pt-6">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center space-x-3 p-4 text-red-500 hover:bg-red-50 rounded-2xl font-bold transition w-full text-left">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span class="text-sm font-bold">Keluar</span>
            </button>
        </form>
    </div>
</aside>