<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-50 flex items-center justify-between px-6 lg:px-10 sticky top-0 z-20">
    {{-- Judul Halaman Dinamis --}}
    <h2 class="font-bold text-gray-800 hidden md:block">@yield('page_title', 'Dashboard Overview')</h2>
    
    <div class="flex items-center gap-6 ml-auto">
        {{-- Profile Section --}}
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-teal-600 font-black uppercase tracking-widest mt-1">Administrator BK</p>
            </div>
            
            <div class="relative group">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D9488&color=fff"
                    class="w-10 h-10 rounded-xl border-2 border-white shadow-sm group-hover:shadow-md transition-all cursor-pointer" 
                    alt="Avatar">
                {{-- Dot Hijau Status Online (Opsional) --}}
                <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></div>
            </div>
        </div>
    </div>
</header>