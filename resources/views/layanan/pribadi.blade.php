@extends('layouts.app')

@section('title', 'Konseling Pribadi - Tenang.id')

@section('content')
    <section class="pt-32 pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                <div class="lg:w-1/3 sticky top-32">
                    <div class="p-8 bg-teal-50 rounded-[2.5rem] border border-teal-100">
                        <div class="w-14 h-14 bg-teal-600 rounded-2xl flex items-center justify-center text-white mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 mb-4">Privasi Terjaga</h2>
                        <p class="text-teal-800 text-sm leading-relaxed mb-6 italic">
                            "Semua yang kamu ceritakan di sini hanya akan berhenti di antara kamu dan konselor. Kamu aman."
                        </p>
                        <a href="{{ route('login') }}"
                            class="block w-full py-4 bg-teal-600 text-white text-center rounded-2xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-100">
                            Buat Janji Temu
                        </a>
                    </div>
                </div>

                <div class="lg:w-2/3">
                    <nav class="flex mb-8 text-sm font-medium text-gray-400">
                        <a href="/layanan" class="hover:text-teal-600">Layanan</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Konseling Pribadi</span>
                    </nav>

                    <h1 class="text-4xl font-black text-gray-900 mb-6">Temukan Ketenangan Lewat Cerita.</h1>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        Konseling pribadi adalah layanan khusus bagi kamu yang ingin berbagi beban pikiran, masalah
                        emosional, atau kendala sosial secara privat. Tidak ada masalah yang terlalu kecil atau terlalu
                        besar untuk didengarkan.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                        <div class="p-6 border border-gray-100 rounded-3xl">
                            <h4 class="font-bold text-gray-900 mb-2">Masalah Emosional</h4>
                            <p class="text-sm text-gray-500">Kecemasan, stres belajar, atau rasa tidak percaya diri.</p>
                        </div>
                        <div class="p-6 border border-gray-100 rounded-3xl">
                            <h4 class="font-bold text-gray-900 mb-2">Masalah Sosial</h4>
                            <p class="text-sm text-gray-500">Konflik dengan teman, masalah keluarga, atau perundungan
                                (bullying).</p>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Apa yang akan kamu dapatkan?</h3>
                    <ul class="space-y-4 text-gray-600">
                        <li class="flex gap-4">
                            <span
                                class="flex-shrink-0 w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xs font-bold">✓</span>
                            Pikiran yang lebih lega setelah bercerita.
                        </li>
                        <li class="flex gap-4">
                            <span
                                class="flex-shrink-0 w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xs font-bold">✓</span>
                            Sudut pandang baru dalam menghadapi masalah.
                        </li>
                        <li class="flex gap-4">
                            <span
                                class="flex-shrink-0 w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-xs font-bold">✓</span>
                            Strategi koping (cara mengatasi) stres yang sehat.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection