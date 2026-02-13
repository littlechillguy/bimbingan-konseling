<nav x-data="{ open: false, atTop: true, userMenu: false }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
    :class="{ 'bg-black/20 backdrop-blur-lg shadow-lg border-b border-white/10': !atTop, 'bg-transparent': atTop }"
    class="fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">

            <a href="{{ route('home') }}" class="flex items-center group outline-none">
                <div class="relative">
                    {{-- Logo Putih Anda --}}
                    <img src="{{ asset('asset/logo43.png') }}" alt="Logo Sekolah"
                        class="h-14 w-auto object-contain transition-transform duration-300 group-hover:scale-105 drop-shadow-md">

                    {{-- Efek cahaya Orange di belakang logo saat hover --}}
                    <div
                        class="absolute inset-0 bg-orange-500/30 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-8 text-sm font-bold">
                {{-- Link menu dengan warna putih/abu terang agar kontras --}}
                <a href="{{ route('home') }}"
                    class="text-white hover:text-orange-400 transition drop-shadow-sm">Beranda</a>
                <a href="{{ route('layanan') }}"
                    class="text-white hover:text-orange-400 transition drop-shadow-sm">Layanan</a>
                <a href="#" class="text-white hover:text-orange-400 transition drop-shadow-sm">Panduan</a>

                <div class="h-6 w-px bg-white/20 mx-2"></div>

                @auth
                    <div class="relative" @click.away="userMenu = false">
                        <button @click="userMenu = !userMenu" class="flex items-center space-x-3 focus:outline-none group">
                            <div class="text-right">
                                <p class="text-[10px] text-white/60 font-medium uppercase tracking-wider">Siswa</p>
                                <p class="text-sm font-bold text-white group-hover:text-orange-400 transition">
                                    {{ Auth::user()->name }}
                                </p>
                            </div>
                            <div
                                class="w-10 h-10 bg-orange-500 border-2 border-white/50 rounded-full flex items-center justify-center text-white shadow-lg overflow-hidden group-hover:border-orange-400 transition">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>

                        <div x-show="userMenu" x-cloak x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-2 border-b border-gray-50 mb-2">
                                <p class="text-xs text-gray-400">Email Anda</p>
                                <p class="text-sm font-semibold text-gray-700 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ url('/dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50 hover:text-orange-600 transition font-medium">Dashboard</a>
                            <hr class="my-2 border-gray-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-bold">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Tombol Login Tema Orange --}}
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition shadow-lg shadow-orange-900/20 font-bold active:scale-95 border border-orange-400/50">
                        Mulai Konseling
                    </a>
                @endauth
            </div>

            <div class="md:hidden flex items-center space-x-4">
                <button @click="open = !open"
                    class="text-white focus:outline-none p-2 bg-white/10 rounded-xl transition">
                    <svg class="h-6 w-6" x-show="!open" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    <svg class="h-6 w-6" x-show="open" x-cloak fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        @click.away="open = false"
        class="md:hidden bg-[#1A1A1A]/95 backdrop-blur-xl px-4 pt-2 pb-8 space-y-2 shadow-2xl border-b border-white/10">
        <a href="{{ route('home') }}"
            class="block px-4 py-4 text-base font-bold text-white border-b border-white/5">Beranda</a>
        <a href="{{ route('layanan') }}"
            class="block px-4 py-4 text-base font-bold text-white border-b border-white/5">Layanan</a>

        <div class="pt-4">
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="block w-full text-center px-6 py-4 bg-orange-500 text-white rounded-2xl font-bold shadow-lg shadow-orange-500/20">
                    Dashboard Siswa
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="block w-full text-center px-6 py-4 bg-orange-500 text-white rounded-2xl font-bold shadow-lg shadow-orange-500/20">
                    Mulai Konseling
                </a>
            @endauth
        </div>
    </div>
</nav>