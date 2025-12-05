<x-guest-layout title="Login Akun Pendaftar">

    <!-- LOGO -->
    <div class="flex justify-center mb-4">
        <div class="bg-white/20 p-4 rounded-2xl backdrop-blur-md shadow-md">
            <x-application-logo class="w-14 h-14 text-white" />
        </div>
    </div>

    <!-- TITLE -->
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold text-white">Selamat Datang</h1>
        <p class="text-purple-200 text-sm">Login Akun Pendaftar</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- EMAIL --}}
        <div>
            <label class="text-sm text-purple-200">Email</label>
            <input type="email" name="email"
                class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                       border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none"
                placeholder="Masukkan email">
        </div>

        {{-- PASSWORD --}}
        <div>
            <label class="text-sm text-purple-200">Password</label>

            <div class="relative">
                <input id="password" type="password" name="password"
                       class="w-full px-4 py-3 rounded-lg bg-white/10 text-white placeholder-purple-300
                              border border-white/20 focus:ring-2 focus:ring-purple-300 outline-none"
                       placeholder="Masukkan password">

                <!-- TOGGLE BUTTON (EYE / EYE-OFF) -->
                <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-3 flex items-center text-purple-300 hover:text-purple-100">
                    👁️
                </button>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center space-x-2 text-purple-200 text-sm">
                <input type="checkbox" name="remember" class="rounded border-white/30 bg-white/10 text-purple-400">
                <span>Ingat saya</span>
            </label>

            <a href="{{ route('password.request') }}" class="text-purple-300 text-sm hover:text-purple-200">
                Lupa password?
            </a>
        </div>

        <button type="submit"
            class="w-full py-3 rounded-lg bg-purple-600 hover:bg-purple-700 text-white font-semibold shadow-lg transition">
            Login
        </button>

        <p class="text-center text-purple-200 text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-purple-300 hover:text-purple-100 font-semibold">
                Daftar sekarang
            </a>
        </p>

        <p class="text-center text-purple-300 text-xs mt-6">
            PMB Politeknik Gorontalo © {{ date('Y') }}
        </p>
    </form>

    <!-- SCRIPT SHOW/HIDE PASSWORD -->
    <script>
        const passwordField = document.getElementById('password');
        const toggleBtn = document.getElementById('togglePassword');

        toggleBtn.addEventListener('click', () => {
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;

            // Ganti icon mata & mata dicoret
            toggleBtn.textContent = type === "password" ? "👁️" : "👁‍🗨";
        });
    </script>

</x-guest-layout>
