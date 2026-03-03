<nav x-data="{ open: false, atTop: true, userMenu: false, homeMenu: false }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
    :class="{ 'py-1 shadow-2xl': !atTop, 'py-2': atTop }"
    class="fixed w-full z-50 transition-all duration-300 bg-teal-900 border-b border-white/10">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center group relative">
                <div class="h-10 w-10 bg-white/10 rounded-xl flex items-center justify-center border border-white/20 group-hover:rotate-6 transition-transform duration-500">
                    <img src="{{ asset('asset/logo43.png') }}" alt="Logo" class="h-7 w-auto object-contain">
                </div>
                <div class="ml-3 flex flex-col justify-center">
                    <span class="text-[13px] sm:text-[15px] font-black text-white leading-none tracking-tight uppercase">Bimbingan Konseling</span>
                    <span class="text-[9px] sm:text-[10px] font-bold tracking-[0.2em] text-teal-300/80 uppercase mt-0.5">SMKN 43 Jakarta</span>
                </div>
            </a>

            <div class="flex items-center space-x-3 md:space-x-5">

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-2 bg-black/20 rounded-full p-1 border border-white/10">
                    <div class="relative" @mouseenter="homeMenu = true" @mouseleave="homeMenu = false">
                        {{-- Tombol Beranda --}}
                        <button class="px-5 py-2 text-[11px] font-black text-white/70 hover:text-white hover:bg-white/10 rounded-full transition-all duration-300 tracking-widest flex items-center outline-none uppercase">
                            Beranda
                            <svg class="w-3 h-3 ml-2 transition-transform duration-300" :class="homeMenu ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Desktop dengan 'Invisible Bridge' --}}
                        {{-- Kita hilangkan 'mt-2' dan ganti dengan 'pt-2' agar tidak ada celah kosong --}}
                        <div x-show="homeMenu"
                            x-cloak
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            {{-- 'pt-2' berfungsi sebagai jembatan agar mouse tidak dianggap keluar --}}
                            class="absolute left-0 pt-2 w-56 z-50 origin-top">

                            <div class="bg-teal-800 border border-white/10 rounded-2xl shadow-2xl py-3">
                                <a href="{{ route('home') }}#top" class="block px-5 py-2.5 text-[10px] font-black text-teal-100 hover:bg-white/10 hover:text-white uppercase transition-colors tracking-widest">↑ Top Halaman</a>
                                <div class="my-1 border-t border-white/5"></div>
                                <a href="{{ route('home') }}#layanan" class="block px-5 py-2.5 text-[10px] font-black text-teal-100 hover:bg-white/10 hover:text-white uppercase transition-colors tracking-widest">Layanan Kami</a>
                                <a href="{{ route('home') }}#alur" class="block px-5 py-2.5 text-[10px] font-black text-teal-100 hover:bg-white/10 hover:text-white uppercase transition-colors tracking-widest">Alur Konseling</a>
                                <a href="{{ route('home') }}#testimoni" class="block px-5 py-2.5 text-[10px] font-black text-teal-100 hover:bg-white/10 hover:text-white uppercase transition-colors tracking-widest">Testimoni</a>
                                <a href="{{ route('home') }}#tips" class="block px-5 py-2.5 text-[10px] font-black text-teal-100 hover:bg-white/10 hover:text-white uppercase transition-colors tracking-widest">Tips Sehat Mental</a>
                                <a href="{{ route('home') }}#faq" class="block px-5 py-2.5 text-[10px] font-black text-teal-100 hover:bg-white/10 hover:text-white uppercase transition-colors tracking-widest">FAQ</a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('layanan') }}" class="px-5 py-2 text-[11px] font-black text-white/70 hover:text-white hover:bg-white/10 rounded-full transition-all duration-300 uppercase tracking-widest">
                        Layanan
                    </a>
                </div>

                {{-- User / Auth Logic --}}
                @if(auth()->check())
                <div class="relative" @click.away="userMenu = false">
                    <button @click="userMenu = !userMenu" class="flex items-center group focus:outline-none">
                        <div class="w-10 h-10 bg-gradient-to-tr from-teal-400 to-emerald-500 rounded-xl p-[2px] shadow-lg group-hover:scale-105 group-active:scale-95 transition-all duration-300">
                            <div class="w-full h-full bg-teal-900 rounded-[10px] flex items-center justify-center text-white text-xs font-black border border-white/5 uppercase">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="hidden md:block ml-3 text-left leading-tight">
                            <p class="text-[12px] font-bold text-white group-hover:text-teal-300 transition-colors uppercase tracking-tight">{{ auth()->user()->name }}</p>
                            <p class="text-[8px] text-teal-400 font-black uppercase tracking-[0.2em] opacity-80">Siswa Aktif</p>
                        </div>
                    </button>
                    {{-- Dropdown User --}}
                    <div x-show="userMenu" x-cloak
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        class="absolute right-0 mt-4 w-64 origin-top-right bg-teal-800 border border-white/10 rounded-[24px] shadow-2xl py-2 overflow-hidden">
                        <div class="px-6 py-4 border-b border-white/5 mb-1 bg-black/10">
                            <p class="text-[9px] text-teal-400 font-black uppercase tracking-widest mb-1">Status Akun</p>
                            <h4 class="text-white font-black text-sm truncate uppercase">{{ auth()->user()->name }}</h4>
                        </div>
                        <div class="p-2">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-[11px] font-black text-white hover:bg-teal-500/20 rounded-xl transition-colors uppercase tracking-widest">Edit Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-[11px] font-black text-red-400 hover:bg-red-500/10 rounded-xl transition-colors uppercase tracking-widest italic">Logout Account</button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="hidden md:block px-7 py-2.5 bg-teal-500 text-white rounded-full font-black text-[11px] uppercase tracking-[0.15em] hover:bg-teal-400 hover:shadow-teal-500/20 transition-all shadow-xl border border-teal-400/20 active:scale-95">
                    Mulai Konseling
                </a>
                @endif

                {{-- Burger Menu (Tetap) --}}
                <button @click="open = !open" class="md:hidden flex items-center justify-center p-2 rounded-xl bg-white/5 border border-white/10 text-white">
                    <svg class="h-6 w-6" :class="{'rotate-90': open}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu (Tidak Berubah) --}}
    <div x-show="open" x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="md:hidden bg-teal-900 border-t border-white/10 shadow-2xl">

        <div class="px-4 py-6 space-y-1">
            <div class="space-y-1 pb-3">
                <p class="px-3 text-[10px] font-black text-teal-400/60 tracking-widest uppercase mb-2">Navigasi</p>
                <a href="{{ route('home') }}#top" @click="open = false" class="block px-3 py-2 text-white font-bold text-sm hover:bg-white/5 rounded-lg">Beranda</a>
                <div class="pl-6 space-y-1 border-l border-white/10 ml-3">
                    <a href="{{ route('home') }}#layanan" @click="open = false" class="block px-3 py-1.5 text-teal-200/70 text-xs font-bold uppercase">Layanan Kami</a>
                    <a href="{{ route('home') }}#alur" @click="open = false" class="block px-3 py-1.5 text-teal-200/70 text-xs font-bold uppercase">Alur Konseling</a>
                    <a href="{{ route('home') }}#testimoni" @click="open = false" class="block px-3 py-1.5 text-teal-200/70 text-xs font-bold uppercase">Testimoni</a>
                    <a href="{{ route('home') }}#tips" @click="open = false" class="block px-3 py-1.5 text-teal-200/70 text-xs font-bold uppercase">Tips Sehat Mental</a>
                    <a href="{{ route('home') }}#faq" @click="open = false" class="block px-3 py-1.5 text-teal-200/70 text-xs font-bold uppercase">FAQ</a>
                </div>
            </div>

            <a href="{{ route('layanan') }}" @click="open = false" class="block px-3 py-3 text-white font-black text-sm uppercase bg-white/5 rounded-xl">Layanan</a>

            <div class="pt-4 mt-4 border-t border-white/5">
                @if(!auth()->check())
                <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-4 bg-teal-500 rounded-2xl text-white font-black text-xs tracking-widest uppercase shadow-lg">
                    Mulai Konseling
                </a>
                @endif
            </div>
        </div>
    </div>
</nav>