@extends('layouts.app')

@section('title', 'Bimbingan Karir - Tenang.id')

@section('content')
    <section class="pt-32 pb-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row-reverse gap-16 items-start">
                <div class="lg:w-1/3 sticky top-32">
                    <div class="p-8 bg-blue-50 rounded-[2.5rem] border border-blue-100">
                        <div class="w-14 h-14 bg-blue-600 rounded-2xl flex items-center justify-center text-white mb-6">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-gray-900 mb-4">Rancang Masa Depan</h2>
                        <p class="text-blue-800 text-sm leading-relaxed mb-6 italic">
                            "Jangan hanya mengikuti arus, mari kita temukan pelabuhan yang tepat untuk bakatmu."
                        </p>
                        <a href="{{ route('login') }}"
                            class="block w-full py-4 bg-blue-600 text-white text-center rounded-2xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-100">
                            Mulai Tes Minat
                        </a>
                    </div>
                </div>

                <div class="lg:w-2/3">
                    <nav class="flex mb-8 text-sm font-medium text-gray-400">
                        <a href="/layanan" class="hover:text-teal-600">Layanan</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Bimbingan Karir</span>
                    </nav>

                    <h1 class="text-4xl font-black text-gray-900 mb-6">Pilih Langkahmu dengan <span
                            class="text-blue-600">Pasti.</span></h1>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        Layanan ini dirancang untuk membantu kamu mengenali potensi diri, minat akademik, hingga perencanaan
                        karir setelah lulus sekolah. Kami membantu memetakan jalan agar masa depanmu lebih terukur.
                    </p>

                    <div class="space-y-6 mb-12">
                        <div
                            class="flex items-start gap-6 p-6 bg-white border border-gray-100 rounded-[2rem] hover:shadow-xl hover:shadow-blue-50 transition-all">
                            <div class="text-4xl font-black text-blue-100">01</div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Eksplorasi Jurusan</h4>
                                <p class="text-gray-500 text-sm">Konsultasi mendalam tentang pemilihan jurusan di Perguruan
                                    Tinggi yang sesuai dengan nilai akademik dan passion.</p>
                            </div>
                        </div>
                        <div
                            class="flex items-start gap-6 p-6 bg-white border border-gray-100 rounded-[2rem] hover:shadow-xl hover:shadow-blue-50 transition-all">
                            <div class="text-4xl font-black text-blue-100">02</div>
                            <div>
                                <h4 class="font-bold text-gray-900 mb-1">Tes Bakat Minat</h4>
                                <p class="text-gray-500 text-sm">Penggunaan instrumen asesmen formal untuk melihat
                                    kecenderungan profesi yang paling cocok untuk kepribadianmu.</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-[2rem]">
                        <h3 class="font-bold text-gray-900 mb-4 italic text-center">"Sukses bukan tentang menjadi yang
                            terbaik di mata orang lain, tapi menjadi versi terbaik dari dirimu sendiri."</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection