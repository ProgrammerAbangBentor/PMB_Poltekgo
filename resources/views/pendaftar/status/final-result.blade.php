<x-pendaftar.layout title="Hasil Akhir PMB">

<div class="pb-28">

    {{-- HEADER --}}
    <div class="relative">
        <div class="bg-gradient-to-br from-purple-700 to-indigo-700 p-8 pb-20 rounded-b-[40px] text-white shadow-lg">
            <h1 class="text-2xl font-semibold">Hasil Akhir PMB</h1>
            <p class="opacity-80 text-sm">Pengumuman resmi kelulusan kamu</p>
        </div>
    </div>

    <div class="px-5 -mt-16 space-y-5 relative z-10">

        {{-- KARTU UTAMA --}}
        <div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-100">

            @if ($applicant->is_lulus_final)
                <div class="text-center">
                    <div class="text-5xl mb-3">🎉</div>
                    <h2 class="text-xl font-bold text-green-700">SELAMAT!</h2>
                    <p class="text-gray-600 mt-2">
                        Kamu dinyatakan <strong>Lulus Final PMB</strong>.
                    </p>
                </div>
            @else
                <div class="text-center">
                    <div class="text-5xl mb-3">😢</div>
                    <h2 class="text-xl font-bold text-red-600">BELUM LULUS</h2>
                    <p class="text-gray-600 mt-2">
                        Kamu belum memenuhi syarat kelulusan PMB.
                    </p>
                </div>
            @endif
        </div>

        {{-- INFORMASI NILAI --}}
        <div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-100">
            <h3 class="font-semibold text-gray-800 mb-2">Informasi Nilai</h3>

            @if ($latestScore)
                <p class="text-sm text-gray-700">
                    Nilai Akhir:
                    <strong class="text-purple-700">{{ $latestScore->score }}</strong>
                </p>
                <br>
                <p class="text-xs text-gray-500">
                    Standar Nilai Kelulusan : {{ $latestScore->scoringRule->passing_score }}
                </p>
            @else
                <p class="text-sm text-gray-500">Nilai belum tersedia.</p>
            @endif
        </div>


        {{-- STATUS SINKRONISASI --}}
        @if ($applicant->is_lulus_final)
            <div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-100">
                <h3 class="font-semibold text-gray-800 mb-2">Sinkronisasi ke SAKTI</h3>

                @if ($applicant->synced_to_sakti_at)
                    <p class="text-xs text-green-700">
                        ✔ Data sudah masuk SAKTI<br>
                        Pada: {{ $applicant->synced_to_sakti_at->format('d M Y H:i') }}
                    </p>
                @else
                    <p class="text-xs text-gray-600">Menunggu sinkronisasi dari admin PMB.</p>
                @endif
            </div>
        @endif

        {{-- DOWNLOAD SURAT --}}
        @if ($applicant->is_lulus_final && $applicant->synced_to_sakti_at)
            <a href="{{ route('pendaftar.status.final-result') }}"
               class="block text-center bg-purple-600 text-white py-3 rounded-2xl shadow-lg font-medium">
                📄 Download Surat Kelulusan
            </a>
        @endif

    </div>

</div>

</x-pendaftar.layout>
