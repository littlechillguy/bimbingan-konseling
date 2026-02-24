<nav x-data="{ open: false, atTop: true, userMenu: false }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
    :class="{ 'py-1 shadow-2xl': !atTop, 'py-2': atTop }"
    class="fixed w-full z-50 transition-all duration-300 bg-teal-900 border-b border-white/10">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <a href="{{ route('home') }}" class="flex items-center group relative">
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

            <div class="flex items-center space-x-2 md:space-x-4">
                
                <div class="hidden md:flex items-center space-x-1 bg-black/10 rounded-full p-1 border border-white/5 mr-2">
                    <a href="{{ route('home') }}" class="px-4 py-1.5 text-[11px] font-black text-white/80 hover:text-white hover:bg-white/10 rounded-full transition-all tracking-wide">BERANDA</a>
                    <a href="{{ route('layanan') }}" class="px-4 py-1.5 text-[11px] font-black text-white/80 hover:text-white hover:bg-white/10 rounded-full transition-all tracking-wide">LAYANAN</a>
                </div>

                @if(auth()->check())
                    <div class="relative" @click.away="userMenu = false">
                        <button @click="userMenu = !userMenu" class="relative flex items-center group focus:outline-none">
                            <div class="relative z-10">
                                <div class="w-9 h-9 bg-gradient-to-tr from-teal-400 to-emerald-500 rounded-[14px] p-[2px] shadow-lg group-hover:-rotate-6 transition-all duration-300">
                                    <div class="w-full h-full bg-teal-900 rounded-[12px] flex items-center justify-center text-white text-xs font-black overflow-hidden border border-white/5">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </div>
                                </div>
                                <span class="absolute -top-0.5 -right-0.5 flex h-3 w-3">
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-teal-400 border-2 border-teal-900"></span>
                                </span>
                            </div>

                            <div class="hidden md:block ml-2 text-left leading-tight">
                                <p class="text-xs font-black text-white group-hover:text-teal-300 transition-colors">{{ auth()->user()->name }}</p>
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
                                    <h4 class="text-white font-black text-base truncate">{{ auth()->user()->name }}</h4>
                                </div>

                                <div class="p-2 space-y-1">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 hover:bg-teal-500/20 rounded-xl transition-all group/item">
                                        <div class="h-8 w-8 bg-teal-400/10 rounded-lg flex items-center justify-center text-teal-300 group-hover/item:scale-110 transition-transform">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </div>
                                        <span class="ml-3 text-sm font-black text-white">Edit Profil</span>
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
                        class="hidden md:block px-6 py-2.5 bg-teal-500 text-white rounded-full font-black text-[11px] uppercase tracking-widest hover:bg-teal-400 transition-all duration-300 shadow-lg shadow-black/20 border border-teal-400/20">
                        Mulai Konseling
                    </a>
                @endif

                <button @click="open = !open" class="md:hidden flex items-center justify-center p-2 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none">
                    <svg class="h-6 w-6 transition-transform duration-300" :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

            </div>
        </div>
    </div>

    <div x-show="open" x-cloak 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-teal-900 border-t border-white/10 shadow-2xl">
        <div class="px-4 pt-4 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="flex items-center px-4 py-3 bg-white/5 rounded-2xl text-white font-black text-sm tracking-widest uppercase">
                BERANDA
            </a>
            <a href="{{ route('layanan') }}" class="flex items-center px-4 py-3 bg-white/5 rounded-2xl text-white font-black text-sm tracking-widest uppercase">
                LAYANAN
            </a>
            @if(!auth()->check())
            <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-4 bg-teal-500 rounded-2xl text-white font-black text-sm tracking-widest uppercase shadow-lg">
                MULAI KONSELING
            </a>
            @endif
        </div>
    </div>
</nav>