<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                required autofocus />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email (Gmail)')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <hr class="my-6 border-gray-200">
        <h3 class="text-sm font-medium text-gray-700 mb-4">Data Akademik & Pribadi</h3>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="nis" :value="__('NIS (4 Digit)')" />
                <x-text-input id="nis" class="block mt-1 w-full" type="text" name="nis" maxlength="4"
                    :value="old('nis')" required />
                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="nisn" :value="__('NISN (12 Digit)')" />
                <x-text-input id="nisn" class="block mt-1 w-full" type="text" name="nisn" maxlength="12"
                    :value="old('nisn')" required />
                <x-input-error :messages="$errors->get('nisn')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="tempat_lahir" :value="__('Tempat Lahir')" />
                <x-text-input id="tempat_lahir" class="block mt-1 w-full" type="text" name="tempat_lahir"
                    :value="old('tempat_lahir')" required />
                <x-input-error :messages="$errors->get('tempat_lahir')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
                <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir"
                    :value="old('tanggal_lahir')" required />
                <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="asal_smp" :value="__('Asal Sekolah SMP')" />
            <x-text-input id="asal_smp" class="block mt-1 w-full" type="text" name="asal_smp" :value="old('asal_smp')"
                required />
            <x-input-error :messages="$errors->get('asal_smp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="riwayat_penyakit" :value="__('Riwayat Penyakit (Kosongkan jika tidak ada)')" />
            <x-text-input id="riwayat_penyakit" class="block mt-1 w-full" type="text" name="riwayat_penyakit"
                :value="old('riwayat_penyakit')" />
            <x-input-error :messages="$errors->get('riwayat_penyakit')" class="mt-2" />
        </div>

        <hr class="my-6 border-gray-200">
        <h3 class="text-sm font-medium text-gray-700 mb-4">Data Orang Tua & Kontak</h3>

        <div class="mt-4">
            <x-input-label for="nama_orangtua" :value="__('Nama Orang Tua')" />
            <x-text-input id="nama_orangtua" class="block mt-1 w-full" type="text" name="nama_orangtua"
                :value="old('nama_orangtua')" required />
            <x-input-error :messages="$errors->get('nama_orangtua')" class="mt-2" />
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="kontak_siswa" :value="__('No. HP Siswa')" />
                <x-text-input id="kontak_siswa" class="block mt-1 w-full" type="text" name="kontak_siswa"
                    :value="old('kontak_siswa')" required />
                <x-input-error :messages="$errors->get('kontak_siswa')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="kontak_orangtua" :value="__('No. HP Orang Tua')" />
                <x-text-input id="kontak_orangtua" class="block mt-1 w-full" type="text" name="kontak_orangtua"
                    :value="old('kontak_orangtua')" required />
                <x-input-error :messages="$errors->get('kontak_orangtua')" class="mt-2" />
            </div>
        </div>

        <div class="block mt-4">
            <label for="is_mutasi" class="inline-flex items-center">
                <input id="is_mutasi" type="checkbox" name="is_mutasi"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('is_mutasi') ? 'checked' : '' }}>
                <span class="ms-2 text-sm text-gray-600">Siswa Mutasi/Pindahan?</span>
            </label>
        </div>

        <hr class="my-6 border-gray-200">

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Sudah punya akun?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Daftar Siswa') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>