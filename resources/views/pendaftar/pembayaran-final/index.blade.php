<x-pendaftar.layout title="Status Pembayaran Administrasi">

<div class="relative">

    {{-- HEADER --}}
    <div class="bg-gradient-to-br from-purple-700 to-indigo-700 p-8 pb-24 rounded-b-[40px] text-white shadow-lg">
        <h1 class="text-xl font-semibold">Pembayaran Administrasi</h1>
        <p class="opacity-80 text-sm mt-1">Pantau perkembangan pembayaran administrasi kampus.</p>
    </div>

    {{-- FLOATING WRAPPER --}}
    <div class="px-5 -mt-20 space-y-7 relative z-10">

        {{-- Progress Card --}}
        <div class="bg-white rounded-3xl p-6 shadow-md">
            <p class="text-gray-700 mb-2 font-medium">Progress Pembayaran</p>

            @php
                $total = 4;
                $done = 0;
                if ($final?->biaya_pembangunan_lunas) $done++;
                if ($final?->biaya_pkkbm_lunas) $done++;
                if ($final?->biaya_spp_lunas) $done++;
                if ($final?->biaya_praktikum_lunas) $done++;

                $percent = ($done / $total) * 100;
            @endphp

            <div class="h-3 bg-gray-200 rounded-full overflow-hidden mb-2">
                <div class="h-full bg-purple-600" style="width: {{ $percent }}%"></div>
            </div>
            <p class="text-sm text-gray-500">{{ number_format($percent) }}% selesai</p>
        </div>

        {{-- 1. Pembangunan --}}
        <div class="bg-white rounded-3xl p-5 shadow space-y-1">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-gray-800">1. Biaya Pembangunan</p>

                @if($final?->biaya_pembangunan_lunas)
                    <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✔ Lunas
                    </span>
                @else
                    <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✘ Belum
                    </span>
                @endif
            </div>

            <p class="text-sm text-gray-500">
                Status pembayaran biaya pembangunan.
            </p>

            @if($final?->biaya_pembangunan_at)
                <p class="text-xs text-gray-400 mt-1">
                    Dibayar: {{ $final->biaya_pembangunan_at }}
                </p>
            @endif
        </div>

        {{-- 2. PKKBM --}}
        <div class="bg-white rounded-3xl p-5 shadow space-y-1">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-gray-800">2. Biaya PKKBM</p>

                @if($final?->biaya_pkkbm_lunas)
                    <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✔ Lunas
                    </span>
                @else
                    <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✘ Belum
                    </span>
                @endif
            </div>

            <p class="text-sm text-gray-500">
                Status pembayaran kegiatan PKKBM.
            </p>

            @if($final?->biaya_pkkbm_at)
                <p class="text-xs text-gray-400 mt-1">
                    Dibayar: {{ $final->biaya_pkkbm_at }}
                </p>
            @endif
        </div>

        {{-- 3. SPP --}}
        <div class="bg-white rounded-3xl p-5 shadow space-y-1">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-gray-800">3. Biaya SPP</p>

                @if($final?->biaya_spp_lunas)
                    <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✔ Lunas
                    </span>
                @else
                    <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✘ Belum
                    </span>
                @endif
            </div>

            <p class="text-sm text-gray-500">
                Status pembayaran SPP semester.
            </p>

            @if($final?->biaya_spp_at)
                <p class="text-xs text-gray-400 mt-1">
                    Dibayar: {{ $final->biaya_spp_at }}
                </p>
            @endif
        </div>

        {{-- 4. Praktikum --}}
        <div class="bg-white rounded-3xl p-5 shadow space-y-1">
            <div class="flex justify-between items-center">
                <p class="font-semibold text-gray-800">4. Biaya Praktikum</p>

                @if($final?->biaya_praktikum_lunas)
                    <span class="text-green-600 bg-green-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✔ Lunas
                    </span>
                @else
                    <span class="text-red-600 bg-red-100 px-3 py-1 rounded-full text-sm font-medium">
                        ✘ Belum
                    </span>
                @endif
            </div>

            <p class="text-sm text-gray-500">
                Status pembayaran biaya praktikum.
            </p>

            @if($final?->biaya_praktikum_at)
                <p class="text-xs text-gray-400 mt-1">
                    Dibayar: {{ $final->biaya_praktikum_at }}
                </p>
            @endif
        </div>

        {{-- INFORMATION BOX --}}
        <div class="bg-purple-100 text-purple-800 p-4 rounded-xl text-sm">
            Pastikan semua pembayaran sudah lunas agar proses registrasi akhir dapat diproses oleh panitia PMB.
        </div>

    </div>

</div>

</x-pendaftar.layout>
