<x-pendaftar.layout title="Biodata">

<div class="pb-28">

    {{-- HEADER PREMIUM --}}
    <div class="relative">
        <div class="bg-gradient-to-br from-purple-700 to-indigo-700 p-8 pb-24 rounded-b-[40px] text-white shadow-lg">
            <h1 class="text-xl font-semibold">Lengkapi Biodata</h1>
            <p class="opacity-80 text-sm mt-1">Isi sesuai data diri yang valid.</p>
        </div>
    </div>

    {{-- FLOATING FORM WRAPPER --}}
    <div class="px-5 -mt-20 space-y-7 relative z-10">

        {{-- SECTION: DATA DIRI --}}
        <div class="bg-white rounded-3xl shadow-xl p-6 border border-gray-100">

            <h2 class="text-lg font-semibold mb-3 text-gray-900">Data Diri</h2>
            <p class="text-sm text-gray-500 mb-5">Masukkan identitas sesuai dokumen resmi.</p>

            <form action="{{ route('pendaftar.biodata.store') }}" method="POST" class="space-y-6">
                @csrf

                @foreach ($fields as $field)

                    {{-- FIELD WRAPPER --}}
                    <div class="space-y-1">

                        {{-- LABEL --}}
                        <label class="block text-sm font-medium text-gray-700">
                            {{ $field->label }}
                            @if ($field->is_required)
                                <span class="text-red-500">*</span>
                            @endif
                        </label>

                        {{-- INPUT CARD --}}
                        <div class="flex items-center bg-gray-100 rounded-2xl px-4 py-3 shadow-sm
                                    focus-within:ring-2 focus-within:ring-purple-500 transition">

                            {{-- ICON AUTOMATIS --}}
                            <span class="text-gray-400 text-lg mr-3">
                                @switch($field->field_key)
                                    @case('nik') 🧾 @break
                                    @case('tempat_lahir') 📍 @break
                                    @case('tanggal_lahir') 📅 @break
                                    @case('jenis_kelamin') 🧍‍♂️ @break
                                    @default ✏️
                                @endswitch
                            </span>

                            {{-- INPUT TYPES --}}
                            @if ($field->type === 'text')
                                <input type="text"
                                       name="field_{{ $field->id }}"
                                       placeholder="Masukkan {{ strtolower($field->label) }}"
                                       value="{{ $values[$field->id]->field_value ?? '' }}"
                                       class="bg-transparent w-full outline-none text-gray-900 placeholder-gray-400">
                            @endif

                            @if ($field->type === 'number')
                                <input type="number"
                                       name="field_{{ $field->id }}"
                                       placeholder="Masukkan {{ strtolower($field->label) }}"
                                       value="{{ $values[$field->id]->field_value ?? '' }}"
                                       class="bg-transparent w-full outline-none text-gray-900 placeholder-gray-400">
                            @endif

                            @if ($field->type === 'date')
                                <input type="date"
                                       name="field_{{ $field->id }}"
                                       value="{{ $values[$field->id]->field_value ?? '' }}"
                                       class="bg-transparent w-full outline-none text-gray-900">
                            @endif

                            @if ($field->type === 'textarea')
                                <textarea name="field_{{ $field->id }}"
                                          rows="2"
                                          placeholder="Masukkan {{ strtolower($field->label) }}"
                                          class="bg-transparent w-full outline-none text-gray-900 resize-none placeholder-gray-400">{{ $values[$field->id]->field_value ?? '' }}</textarea>
                            @endif

                            @if ($field->type === 'select')
                                <select name="field_{{ $field->id }}"
                                        class="bg-transparent w-full outline-none text-gray-900">
                                    <option value="">— Pilih {{ $field->label }} —</option>

                                    @foreach ($field->options ?? [] as $option)
                                        <option value="{{ $option }}"
                                            @if (($values[$field->id]->field_value ?? '') == $option) selected @endif>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                        </div>

                    </div>
                @endforeach

                <button class="w-full bg-purple-600 hover:bg-purple-700 text-white py-4 rounded-2xl
                               text-base font-semibold shadow-lg transition">
                    Simpan Biodata
                </button>

            </form>
        </div>

    </div>

</div>

</x-pendaftar.layout>
