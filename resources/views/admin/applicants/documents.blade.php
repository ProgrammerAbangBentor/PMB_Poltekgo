@php
    use App\Models\Applicant;
    use Illuminate\Support\Str;

    $applicantId = request()->route('record');

    $applicant = Applicant::with(['documentValues.field'])->find($applicantId);
@endphp

@if ($applicant)
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">Dokumen Pendaftar</h3>

        @forelse ($applicant->documentValues as $doc)
            <div class="border p-3 rounded-lg bg-gray-50 space-y-2">
                <p class="font-semibold text-gray-900">
                    {{ $doc->field->label ?? 'Dokumen' }}
                </p>

                @if ($doc->file_path)
                    @if (Str::endsWith($doc->file_path, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $doc->file_path) }}"
                             class="w-40 rounded-lg shadow">
                    @else
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                           class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-100 text-indigo-700 text-sm font-medium">
                            📄 Lihat Dokumen
                        </a>
                    @endif
                @else
                    <p class="text-sm text-gray-500">Belum ada file yang diupload.</p>
                @endif
            </div>
        @empty
            <p class="text-sm text-gray-500">Belum ada dokumen yang diupload.</p>
        @endforelse
    </div>
@else
    <p class="text-sm text-gray-500">Data pendaftar tidak ditemukan.</p>
@endif
