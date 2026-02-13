@extends('layouts.app')

@section('title', 'Layanan Kami - Tenang.id')

@section('content')
    <section class="relative pt-32 pb-20 overflow-hidden bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 mb-6">
                Layanan <span class="text-teal-600">Terbaik</span> Untuk Kamu
            </h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">
                Pilih kategori bimbingan yang sesuai dengan kebutuhanmu saat ini. Semua sesi dilakukan secara rahasia dan
                profesional.
            </p>
        </div>
    </section>

    <section class="pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    class="group p-10 bg-gray-50 rounded-[3rem] border border-gray-100 hover:bg-teal-600 transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-teal-200">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-teal-600 mb-8 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900 group-hover:text-white transition-colors">Konseling
                        Pribadi</h3>
                    <p class="text-gray-500 group-hover:text-teal-50 mb-8 leading-relaxed">Punya masalah yang sulit
                        diceritakan ke teman atau orang tua? Disini kamu bisa curhat apa saja dengan Guru BK secara empat
                        mata.</p>
                    <ul class="space-y-3 mb-10 text-gray-600 group-hover:text-white">
                        <li class="flex items-center gap-2"><svg class="w-5 h-5 text-teal-500 group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z">
                                </path>
                            </svg> Privasi 100% Terjamin</li>
                        <li class="flex items-center gap-2"><svg class="w-5 h-5 text-teal-500 group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z">
                                </path>
                            </svg> Sesi Online/Offline</li>
                    </ul>
                    <a href="{{ route('layanan.pribadi') }}"
                        class="inline-block px-8 py-4 bg-white text-teal-600 rounded-2xl font-bold group-hover:bg-gray-900 group-hover:text-white transition-all">Pilih
                        Layanan</a>
                </div>

                <div
                    class="group p-10 bg-gray-50 rounded-[3rem] border border-gray-100 hover:bg-blue-600 transition-all duration-500 shadow-sm hover:shadow-2xl hover:shadow-blue-200">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-blue-600 mb-8 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900 group-hover:text-white transition-colors">Bimbingan
                        Karir</h3>
                    <p class="text-gray-500 group-hover:text-blue-50 mb-8 leading-relaxed">Bingung pilih jurusan kuliah atau
                        mau kerja di mana? Mari kita bedah minat dan bakatmu agar tidak salah melangkah.</p>
                    <ul class="space-y-3 mb-10 text-gray-600 group-hover:text-white">
                        <li class="flex items-center gap-2"><svg class="w-5 h-5 text-blue-500 group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z">
                                </path>
                            </svg> Analisis Bakat Minat</li>
                        <li class="flex items-center gap-2"><svg class="w-5 h-5 text-blue-500 group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293l-4 4a1 1 0 01-1.414 0l-2-2a1 1 0 111.414-1.414L9 10.586l3.293-3.293a1 1 0 111.414 1.414z">
                                </path>
                            </svg> Konsultasi Jurusan</li>
                    </ul>
                    <a href="{{ route('layanan.karir') }}"
                        class="inline-block px-8 py-4 bg-white text-blue-600 rounded-2xl font-bold group-hover:bg-gray-900 group-hover:text-white transition-all">Pilih
                        Layanan</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-[#F8FAFC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-16">Bagaimana Cara Kerjanya?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="relative">
                    <div
                        class="w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 relative z-10">
                        1</div>
                    <h4 class="font-bold text-gray-900 mb-2">Pilih Layanan</h4>
                    <p class="text-sm text-gray-500 font-medium">Masuk ke akunmu dan tentukan layanan.</p>
                </div>
                <div class="relative">
                    <div
                        class="w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 relative z-10">
                        2</div>
                    <h4 class="font-bold text-gray-900 mb-2">Tentukan Jadwal</h4>
                    <p class="text-sm text-gray-500 font-medium">Pilih hari dan jam yang tersedia.</p>
                </div>
                <div class="relative">
                    <div
                        class="w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 relative z-10">
                        3</div>
                    <h4 class="font-bold text-gray-900 mb-2">Sesi Konsultasi</h4>
                    <p class="text-sm text-gray-500 font-medium">Lakukan sesi via chat atau tatap muka.</p>
                </div>
                <div class="relative">
                    <div
                        class="w-12 h-12 bg-teal-600 text-white rounded-full flex items-center justify-center font-bold mx-auto mb-6 relative z-10">
                        4</div>
                    <h4 class="font-bold text-gray-900 mb-2">Evaluasi</h4>
                    <p class="text-sm text-gray-500 font-medium">Selesaikan masalahmu bersama kami.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 rounded-[3rem] p-10 md:p-16 flex flex-col md:flex-row items-center gap-10">
                <div class="flex-1">
                    <h2 class="text-3xl font-bold text-white mb-4">Butuh Bantuan Mendesak?</h2>
                    <p class="text-gray-400">Jika kamu merasa sedang dalam kondisi darurat dan butuh teman bicara sekarang
                        juga, klik tombol di samping.</p>
                </div>
                <a href="https://wa.me/628123456789"
                    class="px-10 py-5 bg-teal-500 text-white rounded-2xl font-bold hover:bg-teal-400 transition-all flex items-center gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.031 6.172c-2.32 0-4.519.903-6.16 2.544-3.402 3.402-3.402 8.937 0 12.339.606.606 1.28 1.096 2.015 1.464l-.991 3.011 3.116-.992c.328.064.66.096.994.096 2.32 0 4.519-.903 6.16-2.544 3.402-3.402 3.402-8.937 0-12.339-1.641-1.641-3.84-2.544-6.16-2.544z">
                        </path>
                    </svg>
                    WhatsApp Kami
                </a>
            </div>
        </div>
    </section>
@endsection