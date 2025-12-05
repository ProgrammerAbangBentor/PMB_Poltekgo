<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\PaymentManual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $applicant = Auth::guard('pendaftar')->user();

        $payment = PaymentManual::where('applicant_id', $applicant->id)->first();

        return view('pendaftar.payment.index', [
            'payment' => $payment,
            'amount'  => 150000, // Atur biaya disini
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'proof' => 'required|image|max:5048', // jpg/png max 2MB
        ]);

        $applicant = Auth::guard('pendaftar')->user();

        $path = $request->file('proof')->store('payment_proofs', 'public');

        $payment = PaymentManual::updateOrCreate(
            ['applicant_id' => $applicant->id],
            [
                'amount' => 150000,
                'status' => 'pending',
                'proof'  => $path
            ]
        );

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil dikirim!');
    }
}


