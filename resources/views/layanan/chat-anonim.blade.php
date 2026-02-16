<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Pesan Anonim - TENANG.ID</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #ffffff;
        }
        .soft-shadow {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center">

    <nav class="w-full max-w-2xl p-8 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-2 text-gray-400 hover:text-teal-600 transition-all">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            <span class="text-xs font-bold uppercase tracking-widest">Kembali</span>
        </a>
        <div class="flex items-center gap-2">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Sistem Aktif</span>
        </div>
    </nav>

    <main class="w-full max-w-lg px-6 flex-1 flex flex-col justify-center -mt-12">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-teal-50 text-teal-600 rounded-3xl mb-6 transition-transform hover:scale-105 duration-500 shadow-sm border border-teal-100/50">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m0 0v2m0-2h2m-2 0h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-3">Cerita Secara Anonim</h1>
            <p class="text-gray-500 leading-relaxed text-sm max-w-xs mx-auto">
                Identitas Anda disamarkan sepenuhnya. Guru BK hanya menerima pesan Anda tanpa tahu siapa pengirimnya.
            </p>
        </div>

        <div class="bg-gray-50 border border-gray-100 rounded-2xl p-4 mb-8 flex items-center gap-4">
            <div class="bg-white p-2 rounded-xl shadow-sm">
                <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold text-gray-900 leading-none mb-1">Privasi Terjamin</p>
                <p class="text-[10px] text-gray-500 uppercase tracking-tighter">Enkripsi End-to-End diaktifkan</p>
            </div>
        </div>

        <div class="relative">
            <form action="#" class="bg-white rounded-[2rem] border border-gray-100 soft-shadow overflow-hidden group focus-within:border-teal-200 transition-all">
                <textarea 
                    placeholder="Apa yang ingin kamu sampaikan hari ini?" 
                    rows="5"
                    class="w-full p-8 text-gray-700 font-medium placeholder-gray-300 bg-transparent border-none focus:ring-0 resize-none text-base outline-none"
                ></textarea>
                
                <div class="flex items-center justify-between p-4 bg-gray-50/50 border-t border-gray-50">
                    <div class="flex items-center gap-2 pl-2">
                        <span class="w-2 h-2 bg-teal-500 rounded-full"></span>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">@Siswa_Anonim</span>
                    </div>
                    <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-teal-700 active:scale-95 transition-all shadow-md shadow-teal-100">
                        Kirim Pesan
                    </button>
                </div>
            </form>
            
            <div class="absolute -bottom-12 left-1/2 -translate-x-1/2">
                <p class="text-[10px] font-bold text-gray-300 uppercase tracking-[0.3em]">ID: #{{ substr(md5(Auth::id()), 0, 8) }}</p>
            </div>
        </div>

    </main>

    <footer class="mt-auto pb-10">
        <p class="text-[10px] font-medium text-gray-400">TENANG.ID &bull; Ruang Aman Siswa</p>
    </footer>

</body>
</html>