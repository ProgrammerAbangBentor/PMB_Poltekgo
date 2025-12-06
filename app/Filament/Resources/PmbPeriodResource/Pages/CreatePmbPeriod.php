<?php

namespace App\Filament\Resources\PmbPeriodResource\Pages;

use App\Filament\Resources\PmbPeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePmbPeriod extends CreateRecord
{
    protected static string $resource = PmbPeriodResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
