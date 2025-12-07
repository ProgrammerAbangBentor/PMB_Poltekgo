<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\ApplicantDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentField;
// use App\Models\ApplicantDocument;
use Illuminate\Support\Str;
class DocumentController extends Controller
{
    public function index()
    {
        $applicant = Auth::guard('pendaftar')->user();

        $fields = DocumentField::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $uploads = ApplicantDocument::where('applicant_id', $applicant->id)
            ->get()
            ->keyBy('document_field_id');

        return view('pendaftar.documents.index', compact('fields', 'uploads'));
    }

    public function upload(Request $request, $fieldId)
    {
        $docField = DocumentField::findOrFail($fieldId);

        $request->validate([
            'file' => "required|file|max:{$docField->max_size}|mimes:" . $docField->allowed_types,
        ]);

        $path = $request->file('file')->store('documents', 'public');

        $applicant = Auth::guard('pendaftar')->user();

        ApplicantDocument::updateOrCreate(
            [
                'applicant_id' => $applicant->id,
                'document_field_id' => $docField->id,
            ],
            [
                'file_path' => $path,
            ]
        );

        // ============================
        // CEK STATUS DOKUMEN SELESAI
        // ============================

        $requiredCount = DocumentField::where('is_required', 1)
            ->where('is_active', 1)
            ->count();

        $uploadedCount = ApplicantDocument::where('applicant_id', $applicant->id)
            ->whereIn('document_field_id', function ($q) {
                $q->select('id')
                ->from('document_fields')
                ->where('is_required', 1)
                ->where('is_active', 1);
            })
            ->count();

        // Jika semua dokumen wajib sudah dipenuhi
        if ($uploadedCount >= $requiredCount && $requiredCount > 0) {
            $applicant->update([
                'is_documents_complete' => true,
            ]);
        } else {
            $applicant->update([
                'is_documents_complete' => false,
            ]);
        }

        return back()->with('success', 'Dokumen berhasil diunggah!');
    }

}
