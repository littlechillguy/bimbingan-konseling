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
            /* Memastikan konten tidak terpotong di HP layar pendek */
            min-height: -webkit-fill-available; 
        }
        .soft-shadow {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.06);
        }
        /* Transisi halus untuk textarea */
        textarea::placeholder {
            transition: color 0.3s ease;
        }
        textarea:focus::placeholder {
            color: transparent;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col items-center">

    <header class="w-full max-w-2xl px-6 pt-6 md:pt-10 flex flex-col gap-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-teal-600 transition-all duration-300 group">
                <div class="p-2 rounded-xl group-hover:bg-teal-50 transition-colors">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.2em] hidden sm:block">Dashboard</span>
            </a>

            <div class="flex items-center gap-2 bg-gray-50 px-3 py-1.5 rounded-full border border-gray-100">
                <div class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-[9px] font-bold text-gray-500 uppercase tracking-widest">Sistem Anonim Aktif</span>
            </div>
        </div>

        <div class="text-center space-y-3">
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight text-balance leading-tight">
                Sampaikan sesuatu <span class="text-teal-600 italic">tanpa ragu.</span>
            </h1>
            <p class="text-gray-400 text-xs md:text-sm max-w-[280px] md:max-w-xs mx-auto font-medium">
                Pesan terkirim secara anonim langsung ke konselor sekolah.
            </p>
        </div>
    </header>

    <main class="w-full max-w-lg px-6 mt-8 md:mt-12 mb-16 flex-1 flex flex-col">
        
        @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl text-[11px] font-bold flex items-center gap-3 animate-in fade-in slide-in-from-top-4 duration-500">
            <svg class="w-4 h-4 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            Pesan anonim berhasil terkirim!
        </div>
        @endif

        <div class="relative">
            <form action="{{ route('layanan.chat-anonim.store') }}" method="POST" class="bg-white rounded-[2rem] md:rounded-[2.5rem] border border-gray-100 soft-shadow overflow-hidden focus-within:ring-4 focus-within:ring-teal-50/50 transition-all duration-500">
                @csrf
                <textarea 
                    name="message"
                    placeholder="Tuliskan keresahan atau pertanyaanmu..." 
                    rows="5"
                    required
                    class="w-full p-6 md:p-8 text-gray-700 font-medium placeholder-gray-300 bg-transparent border-none focus:ring-0 resize-none text-sm md:text-base outline-none min-h-[150px]"
                ></textarea>
                
                <div class="flex flex-col sm:flex-row items-center justify-between p-4 bg-gray-50/30 border-t border-gray-50 gap-4">
                    <div class="flex items-center gap-2 pl-2">
                        <div class="w-2 h-2 bg-teal-500 rounded-full shadow-[0_0_8px_rgba(20,184,166,0.5)]"></div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest italic">Identitas Disamarkan</span>
                    </div>
                    <button type="submit" class="w-full sm:w-auto bg-gray-900 text-white px-8 py-4 rounded-xl md:rounded-2xl font-bold text-[10px] uppercase tracking-[0.2em] hover:bg-teal-600 active:scale-95 transition-all duration-300 shadow-xl shadow-gray-200 hover:shadow-teal-100">
                        Kirim Pesan
                    </button>
                </div>
            </form>
            
            <div class="mt-8 text-center opacity-30">
                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-[0.4em]">
                    Session ID: #{{ substr(md5(Auth::id() ?? 'guest'), 0, 8) }}
                </p>
            </div>
        </div>
    </main>

    <footer class="w-full py-8 text-center mt-auto">
        <div class="flex items-center justify-center gap-4">
            <div class="h-[1px] w-6 bg-gray-100"></div>
            <span class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em]">Tenang.id Room</span>
            <div class="h-[1px] w-6 bg-gray-100"></div>
        </div>
    </footer>

</body>
</html>