<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenang.id - Bimbingan Konseling Profesional</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#FCFCFC] text-gray-900 antialiased">

    @include('layouts.navbar')

    <main>
        <section class="py-20 lg:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto">
                    <span class="inline-block py-1 px-3 rounded-full bg-teal-50 text-teal-700 text-sm font-medium mb-6">
                        Teman Cerita Terpercaya
                    </span>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-8">
                        Temukan Ruang Aman untuk <span class="text-teal-600 text-opacity-80">Tumbuh & Pulih</span>
                    </h1>
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        Mulailah perjalanan kesehatan mental Anda dengan bimbingan dari psikolog berlisensi yang memahami kebutuhan Anda secara personal.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="#" class="px-8 py-4 bg-teal-600 text-white rounded-xl font-semibold hover:bg-teal-700 transition duration-300 shadow-lg shadow-teal-200">
                            Jadwalkan Sesi Sekarang
                        </a>
                        <a href="#" class="px-8 py-4 bg-white text-gray-700 border border-gray-200 rounded-xl font-semibold hover:bg-gray-50 transition duration-300">
                            Pelajari Layanan
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 text-center border-2 border-dashed border-gray-200 rounded-3xl py-20">
                <p class="text-gray-400 italic text-lg">Bagian Layanan & Kenapa Memilih Kami akan muncul di sini...</p>
            </div>
        </section>
    </main>

    @include('layouts.footer')

</body>
</html>