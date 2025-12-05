<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SelectionStatusController extends Controller
{
    // ================== HALAMAN STATUS SELEKSI ==================
    public function index()
    {
        $applicant = Auth::guard('pendaftar')->user();

        // Hitung progress
        $stepsCompleted = 0;

        if ($applicant->is_biodata_complete) $stepsCompleted++;
        if ($applicant->is_documents_complete) $stepsCompleted++;
        if ($applicant->is_file_selection_passed) $stepsCompleted++;
        if ($applicant->is_nilai_lulus) $stepsCompleted++;
        if ($applicant->is_lulus_final) $stepsCompleted++;

        $progress = ($stepsCompleted / 5) * 100;

        return view('pendaftar.status.index', [
            'applicant' => $applicant,
            'progress'  => $progress,
        ]);
    }


    // ================== HALAMAN HASIL AKHIR (FINAL) ==================
    public function hasilAkhir()
    {
        $applicant = Auth::guard('pendaftar')->user();

        return view('pendaftar.status.final-result', [
            'applicant' => $applicant,
            'latestScore' => $applicant->latest_score,
        ]);
    }


    // ================== SURAT KELULUSAN (PDF) ==================
    public function downloadSurat()
    {
        $applicant = Auth::guard('pendaftar')->user();

        return "PDF Surat Kelulusan — sedang disiapkan.";
    }
}
