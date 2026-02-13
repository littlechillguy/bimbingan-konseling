<nav x-data="{ open: false, atTop: true, userMenu: false }"
    @scroll.window="atTop = (window.pageYOffset > 10 ? false : true)"
    :class="{ 'bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100': !atTop, 'bg-transparent': atTop }"
    class="fixed w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex items-center space-x-2">
                <div
                    class="w-10 h-10 bg-teal-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-teal-200">
                    T</div>
                <span class="text-2xl font-black text-gray-900 tracking-tight">Tenang<span
                        class="text-teal-600">.id</span></span>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-teal-600 transition">Beranda</a>
                <a href="#layanan" class="hover:text-teal-600 transition">Layanan</a>
                <a href="#" class="hover:text-teal-600 transition">Panduan</a>

                <div class="h-6 w-px bg-gray-200 mx-2"></div>

                @auth
                    <div class="relative" @click.away="userMenu = false">
                        <button @click="userMenu = !userMenu" class="flex items-center space-x-3 focus:outline-none group">
                            <div class="text-right">
                                <p class="text-xs text-gray-400 font-medium">Selamat datang,</p>
                                <p class="text-sm font-bold text-gray-900 group-hover:text-teal-600 transition">
                                    {{ Auth::user()->name }}
                                </p>
                            </div>
                            <div
                                class="w-10 h-10 bg-teal-100 border-2 border-white rounded-full flex items-center justify-center text-teal-700 shadow-sm overflow-hidden">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>

                        <div x-show="userMenu" x-cloak x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            class="absolute right-0 mt-3 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">
                            <a href="{{ url('/dashboard') }}"
                                class="block px-4 py-2 text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">Dashboard</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition">Pengaturan</a>
                            <hr class="my-2 border-gray-50">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-teal-600 text-white rounded-2xl hover:bg-teal-700 transition shadow-lg shadow-teal-200">
                        Mulai Konseling
                    </a>
                @endauth
            </div>

            <div class="md:hidden flex items-center space-x-4">
                @auth
                    <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center text-teal-700">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @endauth
                <button @click="open = !open"
                    class="text-gray-600 focus:outline-none p-2 hover:bg-gray-100 rounded-lg transition">
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
        class="md:hidden bg-white border-b border-gray-100 px-4 pt-2 pb-8 space-y-2 shadow-xl">
        <a href="/" class="block px-3 py-4 text-base font-semibold text-gray-700 border-b border-gray-50">Beranda</a>
        <a href="#layanan"
            class="block px-3 py-4 text-base font-semibold text-gray-700 border-b border-gray-50">Layanan</a>

        @auth
            <div class="hidden md:flex items-center space-x-8 text-sm font-semibold text-gray-600">
                <a href="/" class="hover:text-teal-600 transition">Beranda</a>
                <a href="#layanan" class="hover:text-teal-600 transition">Layanan</a>

                <div class="h-6 w-px bg-gray-200 mx-2"></div>

                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-3 bg-gray-900 text-white rounded-2xl hover:bg-gray-800 transition shadow-lg shadow-gray-200 flex items-center gap-2">
                        <span>Dashboard</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                            </path>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-teal-600 text-white rounded-2xl hover:bg-teal-700 transition shadow-lg shadow-teal-200">
                        Mulai Konseling
                    </a>
                @endauth
            </div>
        @endauth
    </div>
</nav>