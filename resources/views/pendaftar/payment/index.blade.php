<x-pendaftar.layout>

<div class="p-5 space-y-5">

    <div class="bg-white p-5 rounded-xl shadow-lg">
        <p class="font-semibold text-lg">Biaya Pendaftaran</p>
        <p class="text-3xl font-bold text-purple-700">Rp {{ number_format($amount) }}</p>
    </div>

    @if ($payment && $payment->status === 'approved')
        <div class="bg-green-100 text-green-700 p-4 rounded-xl">
            Pembayaran sudah diverifikasi 🎉
        </div>
    @else
        <div class="bg-white p-5 rounded-xl shadow-lg">
            <form action="{{ route('pendaftar.payment.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="block mb-2 font-semibold">Upload Bukti Pembayaran</label>

                <input type="file" name="proof"
                    class="block w-full bg-gray-100 p-3 rounded-lg mb-3">

                @if ($payment && $payment->proof)
                    <p class="text-sm text-gray-600 mb-2">Bukti sebelumnya:</p>
                    <img src="{{ asset('storage/' . $payment->proof) }}" class="w-32 rounded-lg mb-3">
                @endif

                <button type="submit"
                    class="w-full bg-purple-700 text-white p-4 rounded-xl font-semibold">
                    Upload Bukti
                </button>


                @if ($payment)
                    <p class="mt-3 text-center text-sm text-gray-600">
                        Status: <span class="font-bold">{{ ucfirst($payment->status) }}</span>
                    </p>
                @endif
            </form>
        </div>
    @endif

</div>

</x-pendaftar.layout>
