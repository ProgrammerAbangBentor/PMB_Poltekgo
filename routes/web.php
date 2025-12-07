<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pendaftar\LogoutController;
use App\Http\Controllers\Pendaftar\DashboardController;
use App\Http\Controllers\Pendaftar\PaymentController;
use App\Http\Controllers\Pendaftar\BiodataController;
use App\Http\Controllers\Pendaftar\DocumentController;
use App\Http\Controllers\Pendaftar\SelectionStatusController;
use App\Http\Controllers\Pendaftar\AdministrationPaymentController;
use App\Http\Controllers\Pmb\PmbFinalisasiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:pendaftar')
    ->prefix('pendaftar')
    ->name('pendaftar.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/akun', function () {
            $applicant = Auth::guard('pendaftar')->user();
            return view('pendaftar.account.index', compact('applicant'));
        })->name('account');

        Route::post('/logout', [LogoutController::class, 'logout'])
            ->name('logout');

        Route::get('/payment/midtrans', [PaymentController::class, 'pay'])
             ->name('payment.midtrans');

        Route::get('/payment', [PaymentController::class, 'index'])
            ->name('payment');

        Route::get('/kartu/download', [PaymentController::class, 'downloadKartu'])
            ->name('download.kartu');

        Route::post('/payment/upload', [PaymentController::class, 'upload'])
            ->name('payment.upload');

        Route::get('/biodata', [BiodataController::class, 'index'])
            ->name('biodata.index');

        Route::post('/biodata', [BiodataController::class, 'store'])
            ->name('biodata.store');

        Route::get('/documents', [DocumentController::class, 'index'])
            ->name('documents.index');

        Route::post('/documents/upload/{id}', [DocumentController::class, 'upload'])
            ->name('documents.upload');

        Route::get('/status', [SelectionStatusController::class, 'index'])
            ->name('status.index');

        Route::get('/hasil-akhir', [SelectionStatusController::class, 'hasilAkhir'])
        ->name('status.final-result');


        Route::get('/payment-administration',[AdministrationPaymentController::class, 'index']
        )->name('payment.admin');


});
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])
    ->name('midtrans.callback');

Route::get('/admin/pmb/finalisasi/{id}', [PmbFinalisasiController::class, 'finalisasi'])
    ->name('admin.pmb.finalisasi');
require __DIR__.'/auth.php';


