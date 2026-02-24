@extends('layouts.app')

@section('title', 'Profil Saya - SMKN 43 JAKARTA')

@section('content')
<div class="min-h-screen bg-[#FBFBFB]">
    {{-- Navbar Khusus User/Siswa --}}
    @include('admin.partials.navbar')

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        {{-- Header Section: Responsive Flex --}}
        <header class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div class="space-y-1">
                <h1 class="text-3xl md:text-4xl font-black text-gray-900 tracking-tight">Pengaturan Profil</h1>
                <p class="text-gray-500 font-medium text-sm md:text-base">Kelola informasi akun dan keamanan Anda.</p>
            </div>
            
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-gray-100 rounded-2xl font-bold text-gray-700 shadow-sm hover:bg-gray-50 hover:shadow-md transition-all duration-300 group w-full sm:w-auto">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="text-sm">Kembali ke Home</span>
            </a>
        </header>

        {{-- Main Content: Stacked Cards --}}
        <div class="space-y-6 md:space-y-10">
            
            {{-- Card: Update Profile Info --}}
            <section class="bg-white border border-gray-100 rounded-[2rem] md:rounded-[2.5rem] shadow-sm overflow-hidden transition-all duration-300 hover:shadow-blue-500/5">
                <div class="p-6 md:p-10">
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-2 h-6 bg-blue-500 rounded-full"></div>
                            <h3 class="text-xl font-black text-gray-900">Informasi Pribadi</h3>
                        </div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest pl-5">Identitas dasar akun Anda</p>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </section>

            {{-- Card: Update Password --}}
            <section class="bg-white border border-gray-100 rounded-[2rem] md:rounded-[2.5rem] shadow-sm overflow-hidden transition-all duration-300 hover:shadow-teal-500/5">
                <div class="p-6 md:p-10">
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-2 h-6 bg-teal-500 rounded-full"></div>
                            <h3 class="text-xl font-black text-gray-900">Keamanan Akun</h3>
                        </div>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-widest pl-5">Proteksi kata sandi berkala</p>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </section>

            {{-- Card: Delete Account (Danger Zone) --}}
            <section class="bg-red-50/30 border border-red-100 rounded-[2rem] md:rounded-[2.5rem] overflow-hidden">
                <div class="p-6 md:p-10">
                    <div class="mb-8">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-2 h-6 bg-red-500 rounded-full"></div>
                            <h3 class="text-xl font-black text-red-600">Hapus Akun</h3>
                        </div>
                        <p class="text-sm text-gray-600 font-medium pl-5 leading-relaxed">Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen.</p>
                    </div>
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </section>
        </div>

        {{-- Footer Credit --}}
        <footer class="mt-12 text-center">
            <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em]">BK SMKN 43 Jakarta • Student Profile Management</p>
        </footer>
    </div>
</div>

<style>
    /* Mengatasi padding internal form bawaan Breeze */
    .max-w-xl { max-width: 100% !important; }
    
    /* Responsive Form Elements */
    input, select, textarea {
        width: 100% !important;
        border-radius: 1rem !important;
        border: 1px solid #f3f4f6 !important;
        background-color: #f9fafb !important;
        padding: 0.75rem 1rem !important;
        font-size: 0.875rem !important;
        transition: all 0.3s ease !important;
    }
    
    input:focus {
        background-color: #ffffff !important;
        border-color: #0D9488 !important;
        box-shadow: 0 0 0 4px rgba(13, 148, 136, 0.1) !important;
        outline: none !important;
    }

    /* Action Buttons Styling */
    button[type="submit"] {
        width: 100%;
        @media (min-width: 640px) { width: auto; }
        background-color: #111827 !important;
        color: white !important;
        padding: 0.75rem 2rem !important;
        border-radius: 1rem !important;
        font-weight: 800 !important;
        font-size: 0.75rem !important;
        text-transform: uppercase !important;
        letter-spacing: 0.1em !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
    }

    button[type="submit"]:hover {
        background-color: #0D9488 !important;
        transform: translateY(-1px);
        box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.2) !important;
    }
</style>
@endsection