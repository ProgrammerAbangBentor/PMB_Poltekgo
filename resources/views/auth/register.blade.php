@php
    $jalurMasuk = $jalurMasuk ?? [];
    $prodiList = $prodiList ?? [];
@endphp

<x-guest-layout title="Daftar Akun Pendaftar">

    <!-- TITLE -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Daftar Akun</h1>
        <p class="text-purple-200 text-sm">Buat akun pendaftar baru</p>
    </div>

    <!-- FORM -->
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Nama Lengkap --}}
        <div>
            <label class="text-sm text-purple-200">Nama Lengkap</label>
            <input id="name" name="name" type="text"
                   value="{{ old('name') }}"
                   required
                   class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                   border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none">
            <x-input-error :messages="$errors->get('name')" class="text-red-300 mt-1" />
        </div>

        {{-- NIK --}}
        <div>
            <label class="text-sm text-purple-200">NIK</label>
            <input id="nik" name="nik" type="text"
                value="{{ old('nik') }}"
                required
                maxlength="16"
                class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none">
            <x-input-error :messages="$errors->get('nik')" class="text-red-300 mt-1" />
        </div>


        {{-- No HP --}}
        <div>
            <label class="text-sm text-purple-200">No HP</label>
            <input id="phone" name="phone" type="text"
                   value="{{ old('phone') }}"
                   class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                   border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none">
            <x-input-error :messages="$errors->get('phone')" class="text-red-300 mt-1" />
        </div>

        {{-- Email --}}
        <div>
            <label class="text-sm text-purple-200">Email</label>
            <input id="email" name="email" type="email"
                   value="{{ old('email') }}" required
                   class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                   border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none">
            <x-input-error :messages="$errors->get('email')" class="text-red-300 mt-1" />
        </div>

        {{-- Password --}}
        <div>
            <label class="text-sm text-purple-200">Password</label>
            <input id="password" name="password" type="password" required
                   class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                   border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none">
            <x-input-error :messages="$errors->get('password')" class="text-red-300 mt-1" />
        </div>

        {{-- Password Confirmation --}}
        <div>
            <label class="text-sm text-purple-200">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                   border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none">
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-red-300 mt-1" />
        </div>

        {{-- Jalur Masuk --}}
        <div>
            <label class="text-sm text-purple-200">Jalur Masuk</label>
            <select name="entry_path_id"
                    required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-white/20
                    focus:ring-2 focus:ring-purple-300 outline-none">
                <option value="">-- Pilih Jalur Masuk --</option>
                @foreach ($jalurMasuk as $path)
                    <option value="{{ $path->id }}" class="text-black">
                        {{ $path->nama }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('entry_path_id')" class="text-red-300 mt-1" />
        </div>

        {{-- Prodi Pilihan 1 --}}
        <div>
            <label class="text-sm text-purple-200">Prodi Pilihan 1</label>
            <select name="study_program_id_1"
                    required
                    class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-white/20
                    focus:ring-2 focus:ring-purple-300 outline-none">
                <option value="">-- Pilih Program Studi --</option>
                @foreach ($prodiList as $prodi)
                    <option value="{{ $prodi->id }}" class="text-black">
                        {{ $prodi->nama }} ({{ $prodi->jenjang }})
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('study_program_id_1')" class="text-red-300 mt-1" />
        </div>

        {{-- Prodi Pilihan 2 (opsional, tidak disimpan) --}}
        <div>
            <label class="text-sm text-purple-200">Prodi Pilihan 2 (Opsional)</label>
            <select name="study_program_id_2"
                    class="w-full px-4 py-3 rounded-lg bg-white/10 text-white border border-white/20
                    focus:ring-2 focus:ring-purple-300 outline-none">
                <option value="">-- Pilih Program Studi --</option>
                @foreach ($prodiList as $prodi)
                    <option value="{{ $prodi->id }}" class="text-black">
                        {{ $prodi->nama }} ({{ $prodi->jenjang }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit -->
        <button type="submit"
            class="w-full py-3 rounded-lg bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow-lg transition">
            Daftar
        </button>

        <!-- Link ke Login -->
        <p class="text-center text-purple-200 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-purple-300 hover:text-purple-100 font-semibold">
                Login sekarang
            </a>
        </p>

        <p class="text-center text-purple-300 text-xs mt-6">
            PMB Politeknik Gorontalo © {{ date('Y') }}
        </p>
    </form>

</x-guest-layout>
