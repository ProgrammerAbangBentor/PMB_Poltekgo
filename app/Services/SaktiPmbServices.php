<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SaktiPmbService
{
    public static function sendToSakti(array $payload)
    {
        $url = env('SAKTI_API_URL') . env('SAKTI_API_ENDPOINT');

        $response = Http::withHeaders([
            'X-PMB-TOKEN' => env('SAKTI_SECRET_TOKEN'),
            'Accept'      => 'application/json',
        ])->post($url, $payload);

        return $response->json();
    }
}
