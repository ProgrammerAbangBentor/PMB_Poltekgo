<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->alias(QrCode::class, 'QrCode');
    }

    public function boot()
    {
        //
    }
}
