@php
    use Illuminate\Support\Str;
@endphp
<x-pendaftar.layout title="Upload Berkas">
<div class="pb-28">

    {{-- HEADER --}}
    <div class="relative">
        <div class="bg-gradient-to-br from-purple-700 to-indigo-700 p-8 pb-24 rounded-b-[40px] text-white shadow-lg">
            <h1 class="text-xl font-semibold">Upload Berkas</h1>
            <p class="opacity-80 text-sm mt-1">Unggah dokumen sesuai ketentuan PMB.</p>
        </div>
    </div>



    {{-- CONTENT --}}
    <div class="px-4 -mt-20 space-y-5 relative z-10">

        @foreach ($fields as $docField)

            @php
                $uploaded = $uploads[$docField->id]->file_path ?? null;
            @endphp

            <div class="bg-white rounded-3xl shadow-lg p-5 border border-gray-100">

                {{-- Header Row --}}
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="font-semibold text-gray-800 text-base">{{ $docField->label }}</h3>
                        <p class="text-xs text-gray-500">{{ $docField->description }}</p>
                    </div>

                    @if ($uploaded)
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                            ✔ Sudah Upload
                        </span>
                    @elseif($docField->is_required)
                        <span class="px-3 py-1 bg-red-100 text-red-600 text-xs rounded-full">
                            ✖ Wajib
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-200 text-gray-600 text-xs rounded-full">
                            Opsional
                        </span>
                    @endif
                </div>

                {{-- Preview --}}
                @if ($uploaded)
                    <div class="mb-4">

                        @if (Str::endsWith($uploaded, ['jpg','jpeg','png']))
                            <img src="{{ asset('storage/' . $uploaded) }}"
                                 class="w-full rounded-xl shadow-md">
                        @else
                            <a href="{{ asset('storage/' . $uploaded) }}" target="_blank"
                               class="block bg-indigo-100 text-indigo-700 text-sm font-semibold p-3 rounded-xl text-center shadow-sm">
                                📄 Lihat Dokumen
                            </a>
                        @endif

                    </div>
                @endif

                {{-- Upload Form --}}
                <form action="{{ route('pendaftar.documents.upload', $docField->id) }}"
                      method="POST" enctype="multipart/form-data" class="space-y-3">

                    @csrf

                    <label class="block">
                        <input type="file" name="file"
                               class="block w-full text-sm text-gray-700
                                      bg-gray-100 px-4 py-3 rounded-xl focus:ring-2
                                      focus:ring-purple-500 outline-none" />

                        <p class="text-xs text-gray-500 mt-1">
                            Tipe: {{ $docField->allowed_types }} —
                            Max: {{ $docField->max_size }} KB
                        </p>
                    </label>

                    <button class="w-full bg-purple-600 hover:bg-purple-700
                                   text-white text-sm font-semibold py-3 rounded-xl
                                   shadow-md transition">
                        {{ $uploaded ? 'Perbarui Dokumen' : 'Upload Dokumen' }}
                    </button>
                </form>

            </div>
        @endforeach

    </div>

</div>

</x-pendaftar.layout>
