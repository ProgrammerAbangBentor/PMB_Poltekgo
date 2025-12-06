<x-pendaftar.layout title="Akun Saya">

    <div class="px-5 mt-5 space-y-5">

        <div class="bg-white shadow rounded-2xl p-5 border">
            <h2 class="text-lg font-semibold text-gray-800">Informasi Akun</h2>

            <div class="mt-3">
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-medium">{{ $applicant->nama }}</p>
            </div>

            <div class="mt-3">
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ $applicant->email }}</p>
            </div>

            <div class="mt-3">
                <p class="text-sm text-gray-500">No HP</p>
                <p class="font-medium">{{ $applicant->no_hp }}</p>
            </div>
        </div>

        {{-- Tombol Logout --}}
        <form method="POST" action="{{ route('pendaftar.logout') }}">
            @csrf
            <button class="w-full py-3 rounded-xl bg-red-600 text-white font-semibold shadow-lg">
                Keluar Akun
            </button>
        </form>

    </div>

</x-pendaftar.layout>
