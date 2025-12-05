<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pendaftar\DashboardController;
use App\Http\Controllers\Pendaftar\PaymentController;
use App\Http\Controllers\Pendaftar\BiodataController;
use App\Http\Controllers\Pendaftar\DocumentController;
use App\Http\Controllers\Pendaftar\SelectionStatusController;
use Illuminate\Support\Facades\Route;


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

        Route::get('/payment/midtrans', [PaymentController::class, 'pay'])
             ->name('payment.midtrans');

        Route::get('/payment', [PaymentController::class, 'index'])
            ->name('payment');

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
});
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])
    ->name('midtrans.callback');




require __DIR__.'/auth.php';


