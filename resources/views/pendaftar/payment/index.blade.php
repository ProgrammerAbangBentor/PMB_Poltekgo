<x-pendaftar.layout>

<div class="p-5 space-y-5">

    <div class="bg-white p-5 rounded-xl shadow-lg">
        <p class="font-semibold text-lg">Biaya Pendaftaran</p>
        <p class="text-3xl font-bold text-purple-700">Rp {{ number_format($amount) }}</p>
    </div>

    @if ($payment && $payment->status === 'approved')
        {{-- SUDAH BAYAR --}}
        <div class="bg-green-100 text-green-700 p-4 rounded-xl">
            Pembayaran sudah diverifikasi 🎉
        </div>

        {{-- TOMBOL DOWNLOAD KARTU REGISTRASI --}}
        <div class="bg-white p-5 rounded-xl shadow-lg">
            <a href="{{ route('pendaftar.download.kartu') }}"
               class="block w-full bg-purple-700 hover:bg-purple-800 text-white p-4 rounded-xl font-semibold text-center">
                Download Kartu Registrasi
            </a>

            <p class="mt-3 text-center text-sm text-gray-600">
                Simpan kartu ini sebagai bukti registrasi resmi PMB.
            </p>
        </div>

    @else
        {{-- BELUM BAYAR --}}
        <div class="bg-white p-5 rounded-xl shadow-lg">

            <!-- Tombol Bayar -->
            <a href="{{ route('pendaftar.payment.midtrans') }}"
                class="block w-full bg-purple-700 hover:bg-purple-800 text-white p-4 rounded-xl font-semibold text-center">
                Bayar Sekarang
            </a>

            @if ($payment)
                <p class="mt-3 text-center text-sm text-gray-600">
                    Status: <span class="font-bold">{{ ucfirst($payment->status) }}</span>
                </p>
            @endif

        </div>
    @endif

</div>

</x-pendaftar.layout>
