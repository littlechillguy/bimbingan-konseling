<footer class="bg-white border-t border-gray-100 pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('asset/logo43.png') }}" alt="Logo SMKN 43" class="w-12 h-12 object-contain">
                    <div class="flex flex-col">
                        <span class="text-lg font-black text-gray-900 tracking-tight leading-none">Bimbingan Konseling</span>
                        <span class="text-sm font-bold text-teal-600 tracking-wider uppercase">SMKN 43 Jakarta</span>
                    </div>
                </div>
                <p class="text-gray-500 max-w-sm leading-relaxed text-sm">
                    Layanan Bimbingan dan Konseling SMKN 43 Jakarta berkomitmen untuk memberikan ruang aman dan dukungan profesional bagi seluruh siswa dalam aspek pribadi, sosial, belajar, dan karir.
                </p>
            </div>

            <div>
                <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.2em] mb-6">Navigasi</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-teal-600 transition-colors">Beranda</a></li>
                    <li><a href="{{ route('layanan.chat-anonim') }}" class="hover:text-teal-600 transition-colors">Chat Anonim</a></li>
                    <li><a href="#" class="hover:text-teal-600 transition-colors">Informasi Karir</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-[10px] font-black text-gray-900 uppercase tracking-[0.2em] mb-6">Kontak Sekolah</h4>
                <ul class="space-y-4 text-gray-500 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="font-bold text-gray-700">Alamat:</span>
                        <span>Jl. Swadarma Raya No.43, Ulujami, Pesanggrahan, Jakarta Selatan.</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="font-bold text-gray-700">Email:</span>
                        <span>info@smkn43jkt.sch.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-50 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-[10px] font-medium text-gray-400 uppercase tracking-widest">
                &copy; 2026 Bimbingan Konseling SMKN 43 Jakarta. All Rights Reserved.
            </div>
            <div class="flex space-x-6 text-[10px] font-bold text-gray-400 uppercase tracking-widest">
                <a href="#" class="hover:text-teal-600 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-teal-600 transition-colors">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>