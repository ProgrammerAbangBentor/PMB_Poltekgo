<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\ApplicantFieldValue;
use App\Models\BiodataField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function index()
    {
        $applicant = Auth::guard('pendaftar')->user();

        $fields = BiodataField::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Ambil value lama kalau sudah ada
        $values = ApplicantFieldValue::where('applicant_id', $applicant->id)
            ->get()
            ->keyBy('biodata_field_id');

        return view('pendaftar.biodata.index', compact('fields', 'values', 'applicant'));
    }

    public function store(Request $request)
    {
        $applicant = Auth::guard('pendaftar')->user();

        $fields = BiodataField::where('is_active', true)->get();

        // VALIDASI DINAMIS
        $rules = [];
        foreach ($fields as $field) {
            if ($field->is_required) {
                $rules["field_{$field->id}"] = 'required';
            }
        }

        $validated = $request->validate($rules);

        // SIMPAN VALUE
        foreach ($fields as $field) {
            $value = $request->input("field_{$field->id}");

            ApplicantFieldValue::updateOrCreate(
                [
                    'applicant_id'      => $applicant->id,
                    'biodata_field_id'  => $field->id,
                ],
                [
                    'field_value' => $value
                ]
            );
        }

        // Update status biodata lengkap
        $applicant->update([
            'is_biodata_complete' => true,
        ]);

        return redirect()->back()->with('success', 'Biodata berhasil disimpan!');
    }
}
