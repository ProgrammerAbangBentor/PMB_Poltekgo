<?php

namespace App\Filament\Resources\PmbWaveResource\Pages;

use App\Filament\Resources\PmbWaveResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePmbWave extends CreateRecord
{
    protected static string $resource = PmbWaveResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
