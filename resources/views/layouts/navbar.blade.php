<nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center">
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-teal-700 tracking-tight">
                    Tenang.id
                </a>
            </div>
            
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-teal-600 transition font-medium">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-teal-600 transition font-medium">Layanan</a>
                <a href="#" class="text-gray-600 hover:text-teal-600 transition font-medium">Tentang Kami</a>
                
                <div class="flex items-center space-x-4 ml-4 border-l pl-6 border-gray-200">
                    @auth
                        {{-- Tampilan saat User sudah Login --}}
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-teal-600 font-medium transition">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-600 font-medium transition">
                                Keluar
                            </button>
                        </form>
                    @else
                        {{-- Tampilan saat User belum Login --}}
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-teal-600 font-medium transition">
                            Masuk
                        </a>
                        
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-teal-600 text-white px-6 py-2.5 rounded-full font-medium hover:bg-teal-700 transition shadow-sm">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>