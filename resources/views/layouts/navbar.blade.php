<nav x-data="{ open: false, atTop: true, userMenu: false }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
    :class="{ 'py-1 shadow-2xl': !atTop, 'py-2': atTop }"
    class="fixed w-full z-50 transition-all duration-300 bg-teal-900 border-b border-white/10">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <a href="{{ Auth::check() ? route('dashboard') : route('home') }}" class="flex items-center group relative">
                <div class="h-10 w-10 bg-white/15 rounded-xl flex items-center justify-center border border-white/20 group-hover:rotate-6 transition-transform duration-500">
                    <img src="{{ asset('asset/logo43.png') }}" alt="Logo" class="h-7 w-auto object-contain">
                </div>
                <div class="ml-3 flex flex-col justify-center">
                    <h1 class="text-lg sm:text-xl font-black text-white leading-none tracking-tight">
                        SMKN <span class="text-teal-400">43</span>
                    </h1>
                    <p class="text-[9px] font-bold tracking-[0.3em] text-teal-200/60 uppercase">Jakarta</p>
                </div>
            </a>

            <div class="flex items-center space-x-4">
                
                @auth
                    <div class="hidden md:flex items-center space-x-1 bg-black/10 rounded-full p-1 border border-white/5 mr-2">
                        <a href="{{ route('dashboard') }}" class="px-4 py-1.5 text-[11px] font-black text-white/80 hover:text-white hover:bg-white/10 rounded-full transition-all tracking-wide">BERANDA</a>
                        <a href="{{ route('layanan') }}" class="px-4 py-1.5 text-[11px] font-black text-white/80 hover:text-white hover:bg-white/10 rounded-full transition-all tracking-wide">LAYANAN</a>
                    </div>

                    <div class="relative" @click.away="userMenu = false">
                        <button @click="userMenu = !userMenu" class="relative flex items-center group focus:outline-none">
                            <div class="relative z-10">
                                <div class="w-9 h-9 bg-gradient-to-tr from-teal-400 to-emerald-500 rounded-[14px] p-[2px] shadow-lg group-hover:-rotate-6 transition-all duration-300">
                                    <div class="w-full h-full bg-teal-900 rounded-[12px] flex items-center justify-center text-white text-xs font-black overflow-hidden border border-white/5">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                </div>
                                <span class="absolute -top-0.5 -right-0.5 flex h-3 w-3">
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-400 border-2 border-teal-900"></span>
                                </span>
                            </div>

                            <div class="hidden md:block ml-2 text-left leading-tight">
                                <p class="text-xs font-black text-white group-hover:text-teal-300 transition-colors">{{ Auth::user()->name }}</p>
                                <p class="text-[8px] text-teal-300/70 font-bold uppercase tracking-widest">Siswa Aktif</p>
                            </div>
                        </button>

                        <div x-show="userMenu" x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             class="absolute right-0 mt-4 w-60 origin-top-right">
                            
                            <div class="overflow-hidden bg-teal-800 border border-white/10 rounded-[24px] shadow-2xl">
                                <div class="px-5 py-4 bg-black/10 border-b border-white/5">
                                    <p class="text-[9px] text-teal-300 font-black uppercase tracking-widest mb-1 opacity-70">Akun Siswa</p>
                                    <h4 class="text-white font-black text-base truncate">{{ Auth::user()->name }}</h4>
                                </div>

                                <div class="p-2 space-y-1">
                                    <a href="{{ url('/dashboard') }}" class="flex items-center px-4 py-3 hover:bg-teal-500/20 rounded-xl transition-all group/item">
                                        <div class="h-8 w-8 bg-teal-400/10 rounded-lg flex items-center justify-center text-teal-300 group-hover/item:scale-110 transition-transform">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                                        </div>
                                        <span class="ml-3 text-sm font-black text-white">Dashboard</span>
                                    </a>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center px-4 py-3 text-red-400 hover:bg-red-500/10 rounded-xl transition-all">
                                            <div class="h-8 w-8 bg-red-500/10 rounded-lg flex items-center justify-center">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7"></path></svg>
                                            </div>
                                            <span class="ml-3 text-sm font-black uppercase italic">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 bg-teal-500 text-white rounded-full font-black text-[11px] uppercase tracking-widest hover:bg-teal-400 transition-all duration-300 shadow-lg shadow-black/20 border border-teal-400/20 active:scale-95">
                        Mulai Konseling
                    </a>
                @endauth

            </div>
        </div>
    </div>
</nav>