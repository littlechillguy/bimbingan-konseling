<nav x-data="{ open: false, atTop: true, userMenu: false }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)" :class="{ 
        'bg-teal-950/90 backdrop-blur-xl shadow-2xl py-2': !atTop, 
        'bg-teal-800/80 backdrop-blur-md py-3': atTop 
    }" class="fixed w-full z-50 transition-all duration-500">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <a href="{{ route('home') }}" class="flex items-center space-x-4 group outline-none">
                <div class="relative flex items-center">
                    <img src="{{ asset('asset/logo43.png') }}" alt="Logo Sekolah"
                        class="h-14 w-auto object-contain transition-transform duration-500 group-hover:scale-110 drop-shadow-md">
                </div>

                <div class="flex flex-col justify-center border-l-2 border-white/10 pl-4">
                    <div class="flex items-center">
                        <span class="text-2xl font-black tracking-tighter text-white leading-none">
                            SMKN <span class="text-teal-400">43</span>
                        </span>
                    </div>
                    <span class="text-sm font-bold tracking-[0.25em] text-teal-200/80 uppercase mt-1 leading-none">
                        Jakarta
                    </span>
                </div>
            </a>

            <div class="flex items-center">

                @auth
                    <div class="hidden md:flex items-center space-x-2 mr-8">
                        <a href="{{ route('home') }}"
                            class="relative px-4 py-2 text-sm font-bold text-white/80 hover:text-white transition-colors group/link">
                            Beranda
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover/link:w-full"></span>
                        </a>
                        <a href="{{ route('layanan') }}"
                            class="relative px-4 py-2 text-sm font-bold text-white/80 hover:text-white transition-colors group/link">
                            Layanan
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-teal-400 transition-all duration-300 group-hover/link:w-full"></span>
                        </a>
                    </div>

                    <div class="relative" @click.away="userMenu = false">
                        <button @click="userMenu = !userMenu"
                            class="flex items-center p-1.5 pr-4 space-x-3 bg-white/5 hover:bg-white/10 border border-white/10 rounded-2xl transition-all duration-300 group active:scale-95 shadow-inner">

                            <div class="relative">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-teal-400 to-teal-600 rounded-xl flex items-center justify-center text-white font-black shadow-lg transform transition-transform group-hover:rotate-6">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div
                                    class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-500 border-2 border-teal-900 rounded-full">
                                </div>
                            </div>

                            <div class="hidden sm:block text-left">
                                <p class="text-[10px] text-teal-400 font-black uppercase tracking-widest leading-none mb-1">
                                    Panel Siswa</p>
                                <p class="text-sm font-bold text-white leading-none">
                                    {{ Auth::user()->name }}
                                </p>
                            </div>

                            <svg class="w-4 h-4 text-teal-400 transition-transform duration-300"
                                :class="{ 'rotate-180': userMenu }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="userMenu" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            class="absolute right-0 mt-4 w-64 bg-teal-950/95 backdrop-blur-2xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] py-3 z-50 border border-white/10 overflow-hidden">

                            <div class="px-6 py-4 mb-2 bg-white/5 border-b border-white/5">
                                <p class="text-[10px] text-teal-400 font-black uppercase tracking-[0.2em] mb-1">Identitas
                                    Siswa</p>
                                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="px-2 space-y-1">
                                <a href="{{ url('/dashboard') }}"
                                    class="flex items-center space-x-3 px-4 py-3 text-sm text-gray-300 hover:bg-teal-500 hover:text-white rounded-2xl transition-all font-bold group/item">
                                    <div class="p-2 bg-white/5 rounded-lg group-hover/item:bg-white/20">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                                            </path>
                                        </svg>
                                    </div>
                                    <span>Dashboard Panel</span>
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center space-x-3 w-full px-4 py-3 text-sm text-red-400 hover:bg-red-500/10 rounded-2xl transition-all font-bold">
                                        <div class="p-2 bg-red-500/5 rounded-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"></path>
                                            </svg>
                                        </div>
                                        <span>Keluar Sesi</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 bg-teal-500 text-white rounded-2xl hover:bg-teal-400 hover:shadow-[0_10px_25px_rgba(20,184,166,0.4)] transition-all duration-300 font-black text-sm tracking-tight active:scale-95 border border-teal-300/20 shadow-lg shadow-teal-950/20">
                        Mulai Konseling
                    </a>
                @endauth

            </div>
        </div>
    </div>
</nav>