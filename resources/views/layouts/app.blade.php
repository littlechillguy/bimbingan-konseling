<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Bimbingan Konseling - SMKN 43 JAKARTA')</title>

    <link rel="icon" type="image/png" href="{{ asset('asset/logo43.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('asset/logo43.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-[#FCFCFC] text-gray-900 antialiased selection:bg-teal-100 selection:text-teal-900">

    {{--
    Logika: Sembunyikan Navbar jika:
    1. Berada di halaman login (Route login)
    2. Berada di halaman register (Route register)
    3. Berada di dalam prefix admin (URL mengandung /admin)
    --}}
    @unless(Route::is('login') || Route::is('register') || request()->is('admin*'))
        @include('layouts.navbar')
    @endunless

    <main class="fade-in min-h-screen">
        {{-- Mendukung komponen x-app-layout (Breeze) --}}
        @if(isset($slot))
            {{ $slot }}
        @endif

        {{-- Mendukung @section('content') (Blade standar) --}}
        @yield('content')
    </main>

    {{--
    Logika: Sembunyikan Footer jika:
    1. Berada di halaman login
    2. Berada di halaman register
    3. Berada di dalam prefix admin
    --}}
    @unless(Route::is('login') || Route::is('register') || request()->is('admin*'))
        @include('layouts.footer')
    @endunless

    @stack('scripts')
</body>

</html>