<x-pendaftar.layout>

    <!-- Curved Header -->
    <div class="relative w-full h-[180px]">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-purple-700 to-indigo-700 rounded-b-[40px] shadow-lg p-7 text-white">
            <p class="text-sm opacity-80">Selamat datang,</p>
            <h1 class="text-2xl font-bold mt-1">{{ $applicant->nama }}</h1>
            <p class="text-sm opacity-90">No. Pendaftaran: {{ $applicant->no_pendaftaran }}</p>
        </div>
    </div>

    <!-- Floating Section -->
    <div class="px-4 -mt-16 space-y-6 relative z-10">

        <!-- Progress -->
        <div class="bg-white p-5 rounded-2xl shadow-xl">
            <p class="font-semibold mb-2">Progress Pendaftaran</p>

            <div class="w-full bg-gray-300 h-2 rounded-full overflow-hidden">
                <div class="bg-purple-600 h-2 rounded-full transition-all duration-700"
                    style="width: {{ $progress }}%"></div>
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


        <!-- Menu Grid -->
        <div class="grid grid-cols-2 gap-4">

            <a href="{{ route('pendaftar.payment') }}" class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center">
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

            @if ($payment && $payment->status === 'approved')
                <a href="{{ route('pendaftar.biodata.index') }}" class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🧍‍♂️</span>
                    </div>
                    <p class="mt-2 font-semibold text-sm">Biodata</p>
                    <p class="text-xs text-gray-500">Isi data diri</p>
                </a>
            @else
                <a href="{{ route('pendaftar.payment') }}"
                class="bg-gray-200 p-5 rounded-xl shadow-lg flex flex-col items-center opacity-60">
            @endif

            @if ($payment && $payment->status === 'approved')
                <a href="{{ route('pendaftar.documents.index') }}" class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center">
                    <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">🗂️</span>
                    </div>
                    <p class="mt-2 font-semibold text-sm">Upload Berkas</p>
                    <p class="text-xs text-gray-500">KTP, KK, Ijazah</p>
                </a>
            @else
                <a href="{{ route('pendaftar.payment') }}"
                class="bg-gray-200 p-5 rounded-xl shadow-lg flex flex-col items-center opacity-60">
            @endif

            @if ($payment && $payment->status === 'approved')
                <a href="{{ route('pendaftar.status.index') }}" class="bg-white p-5 rounded-xl shadow-lg flex flex-col items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <span class="text-2xl">📊</span>
                    </div>
                    <p class="mt-2 font-semibold text-sm">Status Seleksi</p>
                    <p class="text-xs text-gray-500">Pantau hasil</p>
                </a>
            @else
                <a href="{{ route('pendaftar.payment') }}"
                class="bg-gray-200 p-5 rounded-xl shadow-lg flex flex-col items-center opacity-60">
            @endif
        </div>

        <!-- Important Info -->
        <div class="bg-white p-5 rounded-2xl shadow-xl">
            <p class="font-semibold mb-2">Informasi Penting</p>
            <p class="text-gray-600 text-sm leading-relaxed">
                Kamu belum melakukan pembayaran biaya pendaftaran.
                Silakan selesaikan untuk melanjutkan ke biodata.
            </p>
        </div>

    </div>

</x-pendaftar.layout>
