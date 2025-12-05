@php
    use App\Models\Applicant;

    // Ambil ID record dari URL: /admin/applicants/{record}/edit
    $applicantId = request()->route('record');

    $applicant = Applicant::with(['fieldValues.field'])->find($applicantId);
@endphp

@if ($applicant)
    <div class="space-y-4">
        <h3 class="text-lg font-semibold">Detail Biodata</h3>

        @forelse ($applicant->fieldValues as $item)
            <div class="border p-3 rounded-lg bg-gray-50">
                <p class="text-sm text-gray-500">
                    {{ $item->field->label ?? '-' }}
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    {{ $item->value ?? $item->field_value ?? '-' }}
                </p>
            </div>
        @empty
            <p class="text-sm text-gray-500">Belum ada biodata yang diisi.</p>
        @endforelse
    </div>
@else
    <p class="text-sm text-gray-500">Data pendaftar tidak ditemukan.</p>
@endif
