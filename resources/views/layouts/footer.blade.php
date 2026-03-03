<footer class="bg-white border-t border-gray-100 pt-12 pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        {{-- Main Footer Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-10">
            
            {{-- Brand Section --}}
            <div class="md:col-span-5 lg:col-span-6">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="{{ asset('asset/logo43.png') }}" alt="Logo SMKN 43" class="w-10 h-10 object-contain">
                    <div class="flex flex-col">
                        <span class="text-base font-black text-gray-900 tracking-tight leading-none">Bimbingan Konseling</span>
                        <span class="text-[11px] font-bold text-teal-600 tracking-wider uppercase">SMKN 43 Jakarta</span>
                    </div>
                </div>
                <p class="text-gray-500 max-w-sm leading-relaxed text-xs">
                    Memberikan ruang aman dan dukungan profesional bagi seluruh siswa dalam aspek pribadi, sosial, belajar, dan karir.
                </p>
            </div>

            {{-- Quick Links --}}
            <div class="md:col-span-3 lg:col-span-2">
                <h4 class="text-[9px] font-black text-gray-900 uppercase tracking-[0.2em] mb-4">Navigasi</h4>
                <ul class="space-y-2.5 text-gray-500 text-xs">
                    <li><a href="{{ route('home') }}" class="hover:text-teal-600 transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 bg-gray-200 rounded-full"></span>Beranda</a>
                    </li>
                    <li><a href="{{ route('layanan.chat-anonim') }}" class="hover:text-teal-600 transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 bg-gray-200 rounded-full"></span>Chat Anonim</a>
                    </li>
                    <li><a href="{{ route('layanan.karir') }}" class="hover:text-teal-600 transition-colors flex items-center gap-2">
                        <span class="w-1 h-1 bg-gray-200 rounded-full"></span>Eksplorasi Karir</a>
                    </li>
                </ul>
            </div>

            {{-- Contact Section --}}
            <div class="md:col-span-4 lg:col-span-4">
                <h4 class="text-[9px] font-black text-gray-900 uppercase tracking-[0.2em] mb-4">Kontak Sekolah</h4>
                <ul class="space-y-3 text-gray-500 text-xs">
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-teal-600 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <span class="leading-relaxed">JL. CIPULIR 1, Cipulir, Kebayoran Lama, Jakarta Selatan</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-teal-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>info@smkn43jkt.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom Footer --}}
        <div class="border-t border-gray-50 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-[9px] font-bold text-gray-400 uppercase tracking-widest text-center md:text-left">
                &copy; 2026 BK SMKN 43 Jakarta. <span class="hidden sm:inline">All Rights Reserved.</span>
            </div>
            <div class="flex space-x-6 text-[9px] font-black text-gray-400 uppercase tracking-widest">
                <a href="#" class="hover:text-teal-600 transition-colors">Privacy</a>
                <a href="#" class="hover:text-teal-600 transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>