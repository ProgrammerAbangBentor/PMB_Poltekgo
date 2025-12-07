<?php

namespace App\Http\Controllers\Pendaftar;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PaymentController extends Controller
{
    // -------------------------
    // 1. Halaman pembayaran
    // -------------------------
    public function index()
    {
        $pendaftar = Auth::guard('pendaftar')->user();

        $payment = Payment::where('applicant_id', $pendaftar->id)->first();
        $amount  = 150000; // biaya pendaftaran

        return view('pendaftar.payment.index', compact('payment', 'amount'));
    }


    // -------------------------
    // 2. Bayar via Midtrans (Snap)
    // -------------------------
    public function pay()
    {
        $pendaftar = Auth::guard('pendaftar')->user();
        $amount = 150000;

        // Jika sudah bayar sukses → TIDAK BOLEH BAYAR LAGI
        $existing = Payment::where('applicant_id', $pendaftar->id)->first();
        if ($existing && $existing->status === 'approved') {
            return redirect()->route('pendaftar.payment')
                ->with('success', 'Pembayaran sudah berhasil, tidak dapat membayar ulang.');
        }

        // Jika pending/failed → buat order_id baru (WAJIB biar tidak error duplicate order_id)
        $orderId = 'PMB-' . time() . '-' . rand(100, 999);

        $payment = Payment::updateOrCreate(
            ['applicant_id' => $pendaftar->id],
            [
                'order_id' => $orderId,
                'amount'   => $amount,
                'status'   => 'pending',
            ]
        );

        // Konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Data transaksi (DITAMBAHKAN REDIRECT URL)
        $params = [
            'transaction_details' => [
                'order_id'     => $payment->order_id,
                'gross_amount' => $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $pendaftar->name,
                'email'      => $pendaftar->email,
            ],

            // Redirect setelah bayar, belum bayar, atau error
            'finish_redirect_url'   => route('pendaftar.dashboard'),
            'unfinish_redirect_url' => route('pendaftar.payment'),
            'error_redirect_url'    => route('pendaftar.payment'),
        ];

        // Ambil Snap Token
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan snap token
        $payment->update([
            'snap_token' => $snapToken
        ]);

        return view('pendaftar.payment.pay-midtrans', compact('snapToken'));
    }


    // -------------------------
    // 3. Callback Midtrans
    // -------------------------
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        // Validasi signature
        $computedSignature = hash(
            "sha512",
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($computedSignature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $payment = Payment::where('order_id', $request->order_id)->first();

        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        // Update status transaksi
        $status = $request->transaction_status;

        if (in_array($status, ['capture', 'settlement'])) {
            $payment->status = 'approved';
        } elseif ($status == 'pending') {
            $payment->status = 'pending';
        } else {
            $payment->status = 'failed';
        }

        $payment->payment_type   = $request->payment_type ?? null;
        $payment->transaction_id = $request->transaction_id ?? null;
        $payment->raw_response   = json_encode($request->all());
        $payment->save();

        return response()->json(['message' => 'OK']);
    }

public function downloadKartu()
{
    $pendaftar = auth('pendaftar')->user();

    if (!$pendaftar) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $payment = $pendaftar->payment;

    if (!$payment || $payment->status !== 'approved') {
        return back()->with('error', 'Pembayaran belum diverifikasi.');
    }

    // ---- QR CODE FIX (SVG > Base64) ----
    $qrSvg = QrCode::format('svg')
        ->size(140)
        ->generate($pendaftar->nik . ' | ' . $pendaftar->nama);

    $qrBase64 = 'data:image/svg+xml;base64,' . base64_encode($qrSvg);

    // ---- Generate PDF ----
    $pdf = PDF::loadView('pendaftar.kartu', [
        'pendaftar' => $pendaftar,
        'payment'   => $payment,
        'qrBase64'  => $qrBase64
    ])->setPaper('A4', 'portrait');

    return response()->streamDownload(function () use ($pdf) {
        echo $pdf->output();
    }, 'Kartu-Registrasi-' . $pendaftar->nama . '.pdf');
}


}
