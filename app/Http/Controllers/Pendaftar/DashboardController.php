<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
// use App\Models\Payment;
use App\Models\PaymentManual;

class DashboardController extends Controller
{
    public function index()
    {
        $applicant = Auth::guard('pendaftar')->user();
        $payment = PaymentManual::where('applicant_id', $applicant->id)->first();

        $stepsCompleted = 0;

        if ($applicant->is_biodata_complete) $stepsCompleted++;
        if ($applicant->is_documents_complete) $stepsCompleted++;
        if ($applicant->is_file_selection_passed) $stepsCompleted++;
        if ($applicant->is_nilai_lulus) $stepsCompleted++;
        if ($applicant->is_lulus_final) $stepsCompleted++;

        $progress = ($stepsCompleted / 5) * 100;

        return view('pendaftar.dashboard', [
            'applicant' => $applicant,
            'progress' => $progress,
            'payment' => $payment,
        ]);

    }

}
