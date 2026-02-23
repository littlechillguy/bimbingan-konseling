<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-50 flex items-center justify-between px-6 lg:px-10 sticky top-0 z-20">
    <h2 class="font-bold text-gray-800 hidden md:block">@yield('page_title', 'Dashboard Overview')</h2>
    
    <div class="flex items-center gap-6">
        <div class="relative cursor-pointer group">
            <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 border-2 border-white rounded-full {{-- Logic: if $unreadNotifications > 0 --}} flex {{-- else hidden --}} items-center justify-center">
                <span class="text-[8px] text-white font-bold">3</span>
            </div>
            <svg class="w-6 h-6 text-gray-400 group-hover:text-teal-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-teal-600 font-black uppercase tracking-widest mt-1">Administrator BK</p>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D9488&color=fff"
                class="w-10 h-10 rounded-xl border-2 border-white shadow-sm" alt="Avatar">
        </div>
    </div>
</header>