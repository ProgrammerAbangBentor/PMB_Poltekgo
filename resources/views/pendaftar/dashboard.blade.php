<x-pendaftar.layout title="Dashboard">

    @php
        $isPaid = $payment && $payment->status === 'approved';
    @endphp

    <!-- HEADER -->
    <div class="relative w-full h-[180px]">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-700 to-indigo-700 rounded-b-[40px] shadow-lg p-7 text-white">
            <p class="text-sm opacity-80">Selamat datang,</p>
            <h1 class="text-2xl font-bold mt-1">{{ $applicant->nama }}</h1>
            <p class="text-sm opacity-90">No. Pendaftaran: {{ $applicant->no_pendaftaran }}</p>
        </div>
    </div>


    <!-- CONTENT -->
    <div class="px-4 -mt-16 space-y-6 relative z-10">

        <!-- PROGRESS -->
        <div class="bg-white p-5 rounded-2xl shadow-xl">
            <p class="font-semibold mb-2">Progress Pendaftaran</p>

            <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                <div class="bg-purple-600 h-2 rounded-full transition-all duration-700"
                    style="width: {{ $progress }}%">
                </div>
            </div>

            <p class="text-xs text-gray-600 mt-2">
                {{ round($progress) }}% selesai
            </p>
        </div>


        {{-- PAYMENT STATUS --}}
        @if (!$payment)
            <div class="bg-red-100 text-red-700 p-4 rounded-xl shadow">
                Kamu belum melakukan pembayaran biaya pendaftaran.
                <a href="{{ route('pendaftar.payment') }}" class="block mt-2 text-red-800 font-bold underline">
                    Bayar Sekarang →
                </a>
            </div>

        @elseif ($payment->status === 'pending')
            <div class="bg-yellow-100 text-yellow-700 p-4 rounded-xl shadow">
                Bukti pembayaran sudah dikirim. Menunggu verifikasi admin.
                <a href="{{ route('pendaftar.payment') }}" class="block mt-2 text-yellow-800 font-bold underline">
                    Lihat Detail →
                </a>
            </div>

        @elseif ($payment->status === 'approved')
            <div class="bg-green-100 text-green-700 p-4 rounded-xl shadow">
                Pembayaran pendaftaran sudah terverifikasi 🎉
            </div>
        @endif


        <!-- MENU GRID -->
        <div class="grid grid-cols-2 gap-4">

            {{-- PEMBAYARAN --}}
            <a href="{{ route('pendaftar.payment') }}"
                class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">💳</span>
                </div>
                <p class="mt-2 font-semibold text-sm">Pembayaran</p>
                <p class="text-xs text-gray-500">
                    @if (!$payment)
                        Belum bayar
                    @elseif ($payment->status === 'pending')
                        Menunggu
                    @else
                        Lunas
                    @endif
                </p>
            </a>


            {{-- FORMULIR PENDAFTAR --}}
            <a href="{{ $isPaid ? route('pendaftar.biodata.index') : '#' }}"
                class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center
                {{ !$isPaid ? 'opacity-50 pointer-events-none' : '' }}">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">🧍‍♂️</span>
                </div>
                <p class="mt-2 font-semibold text-sm">Formulir Pendaftar</p>
                <p class="text-xs text-gray-500">Isi data diri</p>
            </a>


            {{-- UPLOAD BERKAS --}}
            <a href="{{ $isPaid ? route('pendaftar.documents.index') : '#' }}"
                class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center
                {{ !$isPaid ? 'opacity-50 pointer-events-none' : '' }}">
                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">🗂️</span>
                </div>
                <p class="mt-2 font-semibold text-sm">Upload Berkas</p>
                <p class="text-xs text-gray-500">KTP, KK, Ijazah</p>
            </a>


            {{-- STATUS SELEKSI --}}
            <a href="{{ $isPaid ? route('pendaftar.status.index') : '#' }}"
                class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center
                {{ !$isPaid ? 'opacity-50 pointer-events-none' : '' }}">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">📊</span>
                </div>
                <p class="mt-2 font-semibold text-sm">Status Seleksi</p>
                <p class="text-xs text-gray-500">Pantau hasil</p>
            </a>
            
            <a href="{{ route('pendaftar.payment.admin') }}"
                class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <span class="text-2xl">💰</span>
                </div>
                <p class="mt-2 font-semibold text-sm">Pembayaran Administrasi</p>
                <p class="text-xs text-gray-500">Lihat status pembayaran</p>
            </a>


        </div>


        {{-- INFORMASI PENTING --}}
        @if (!$isPaid)
            <div class="bg-white p-5 rounded-2xl shadow-xl">
                <p class="font-semibold mb-2">Informasi Penting</p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Kamu belum melakukan pembayaran biaya pendaftaran.
                    Silakan selesaikan untuk melanjutkan ke formulir pendaftar.
                </p>
            </div>
        @endif

    </div>

</x-pendaftar.layout>
