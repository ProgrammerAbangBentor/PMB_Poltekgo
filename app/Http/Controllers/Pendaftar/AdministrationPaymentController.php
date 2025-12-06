<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PmbFinalCandidate;

class AdministrationPaymentController extends Controller
{
    public function index()
    {
        $applicant = Auth::guard('pendaftar')->user();

        // pastikan data final candidate sudah ada
        $final = PmbFinalCandidate::where('applicant_id', $applicant->id)->first();

        if (!$final) {
            return redirect()
                ->route('pendaftar.status.index')
                ->with('error', 'Data final calon mahasiswa belum tersedia.');
        }

        return view('pendaftar.pembayaran-final.index', [
            'applicant' => $applicant,
            'final' => $final,
        ]);
    }
}
