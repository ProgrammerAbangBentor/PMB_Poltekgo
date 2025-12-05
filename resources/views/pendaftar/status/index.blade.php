<x-pendaftar.layout title="Status Seleksi">

<div class="pb-28">

    {{-- HEADER --}}
    <div class="relative">
        <div class="bg-gradient-to-br from-indigo-700 to-purple-700 p-8 pb-24 rounded-b-[40px] text-white shadow-lg">
            <h1 class="text-xl font-semibold">Status Pendaftaran</h1>
            <p class="opacity-80 text-sm mt-1">Pantau perkembangan seleksi PMB kamu.</p>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="px-5 -mt-20 space-y-5 relative z-10">

        {{-- PROGRESS BAR --}}
        <div class="bg-white rounded-3xl shadow-xl p-5 border border-gray-100">
            <h3 class="font-semibold text-gray-800 mb-3">Progress Pendaftaran</h3>

            <div class="w-full bg-gray-200 h-3 rounded-full overflow-hidden">
                <div class="h-full bg-purple-600 transition-all duration-700" style="width: {{ $progress }}%;"></div>
            </div>

            <p class="text-xs text-gray-600 mt-2">{{ round($progress) }}% selesai</p>
        </div>


        {{-- STEP 1 — Biodata --}}
        <div class="bg-white rounded-3xl shadow-xl p-5 border border-gray-100">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-800">1. Biodata</h3>

                @if ($applicant->is_biodata_complete)
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">✔ Lengkap</span>
                @else
                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">✖ Belum Lengkap</span>
                @endif
            </div>
            <p class="text-xs text-gray-500">Status kelengkapan formulir biodata pendaftar.</p>
        </div>


        {{-- STEP 2 — Upload Berkas --}}
        <div class="bg-white rounded-3xl shadow-xl p-5 border border-gray-100">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-800">2. Upload Berkas</h3>

                @if ($applicant->is_documents_complete)
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">✔ Lengkap</span>
                @else
                    <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">✖ Belum Lengkap</span>
                @endif
            </div>
            <p class="text-xs text-gray-500">Status kelengkapan dokumen persyaratan PMB.</p>
        </div>


        {{-- STEP 3 — Seleksi Berkas --}}
        <div class="bg-white rounded-3xl shadow-xl p-5 border border-gray-100">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-800">3. Seleksi Berkas</h3>

                @if ($applicant->file_selection_decided_at === null)
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">⏳ Menunggu</span>
                @else
                    @if ($applicant->is_file_selection_passed)
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">✔ Lulus</span>
                    @else
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">✖ Tidak Lulus</span>
                    @endif
                @endif
            </div>

            <p class="text-xs text-gray-500 mb-3">Hasil verifikasi dokumen oleh panitia PMB.</p>

            @if ($applicant->file_selection_decided_at)
                <p class="text-xs text-gray-600">Keputusan: {{ $applicant->file_selection_decided_at->format('d M Y H:i') }}</p>
            @endif
        </div>


        {{-- STEP 4 — Seleksi Nilai --}}
        <div class="bg-white rounded-3xl shadow-xl p-5 border border-gray-100">
            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-800">4. Seleksi Nilai</h3>

                @if ($applicant->latest_score === null)
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">⏳ Menunggu</span>
                @else
                    @if ($applicant->is_nilai_lulus)
                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">✔ Lulus</span>
                    @else
                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">✖ Tidak Lulus</span>
                    @endif
                @endif
            </div>

            <p class="text-xs text-gray-500 mb-3">Penilaian hasil tes atau evaluasi.</p>

            @if ($applicant->latest_score)
                <p class="text-xs text-gray-600">
                    Nilai: <strong>{{ $applicant->latest_score->score }}</strong>
                    (Passing Grade: {{ $applicant->latest_score->scoringRule->passing_score }})
                </p>
            @endif
        </div>


        {{-- STEP 5 — Hasil Akhir PMB --}}
        <div class="bg-white rounded-3xl shadow-xl p-5 border border-gray-100">

            <div class="flex justify-between items-center mb-2">
                <h3 class="font-semibold text-gray-800">5. Hasil Akhir PMB</h3>

                @if ($applicant->is_lulus_final)
                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">🎉 Lulus Final</span>
                @else
                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">⏳ Diproses</span>
                @endif
            </div>

            <p class="text-xs text-gray-500 mb-3">Status kelulusan akhir berdasarkan administrasi dan nilai.</p>

            @if ($applicant->is_lulus_final)
                @if ($applicant->synced_to_sakti_at)
                    <p class="text-xs text-green-600">
                        ✔ Data telah disinkronkan ke Sistem Akademik (SAKTI)<br>
                        Pada: {{ $applicant->synced_to_sakti_at->format('d M Y H:i') }}
                    </p>
                @else
                    <p class="text-xs text-gray-600">Menunggu proses sinkronisasi ke SAKTI.</p>
                @endif
            @endif

            {{-- TOMBOL DOWNLOAD SURAT --}}
            {{-- @if ($applicant->is_lulus_final && $applicant->synced_to_sakti_at) --}}
                <a href="{{ route('pendaftar.status.final-result') }}"
                   class="block text-center bg-purple-600 text-white py-3 rounded-2xl shadow-lg font-medium mt-3">
                    📄 Download Surat Kelulusan
                </a>
            {{-- @endif --}}

        </div>

    </div>

</div>

</x-pendaftar.layout>
