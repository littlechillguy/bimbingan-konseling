<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-black text-teal-700 tracking-tight flex items-center gap-2">
                    <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                    <span>Tenang.id</span>
                </a>
            </div>
            
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-teal-600 transition font-semibold text-sm tracking-wide">BERANDA</a>
                <a href="#" class="text-gray-600 hover:text-teal-600 transition font-semibold text-sm tracking-wide">LAYANAN</a>
                <a href="#" class="text-gray-600 hover:text-teal-600 transition font-semibold text-sm tracking-wide">TENTANG</a>
                
                <div class="flex items-center space-x-5 ml-4 border-l pl-6 border-gray-200">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-teal-600 font-bold transition text-sm">DASHBOARD</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-600 font-bold transition text-sm">KELUAR</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-teal-600 font-bold transition text-sm">MASUK</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-teal-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-teal-700 transition shadow-md shadow-teal-100 text-sm">
                                DAFTAR SISWA
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-500 bg-gray-50 hover:text-teal-600 hover:bg-teal-50 transition focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white border-b border-gray-100 shadow-xl">
        <div class="px-4 pt-2 pb-6 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-700 hover:bg-teal-50 hover:text-teal-700 transition">Beranda</a>
            <a href="#" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-700 hover:bg-teal-50 hover:text-teal-700 transition">Layanan</a>
            <a href="#" class="block px-4 py-3 rounded-xl text-base font-bold text-gray-700 hover:bg-teal-50 hover:text-teal-700 transition">Tentang Kami</a>
            
            <div class="pt-4 mt-4 border-t border-gray-100 grid grid-cols-2 gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="col-span-2 text-center px-4 py-3 rounded-xl bg-gray-100 text-gray-700 font-bold">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="col-span-2 text-center">
                        @csrf
                        <button type="submit" class="w-full px-4 py-3 rounded-xl text-red-500 font-bold border border-red-100">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 rounded-xl bg-gray-50 text-gray-700 font-bold">Masuk</a>
                    <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 rounded-xl bg-teal-600 text-white font-bold shadow-lg shadow-teal-100">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</nav>