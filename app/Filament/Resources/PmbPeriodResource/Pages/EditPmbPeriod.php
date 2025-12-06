<?php

namespace App\Filament\Resources\PmbPeriodResource\Pages;

use App\Filament\Resources\PmbPeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPmbPeriod extends EditRecord
{
    protected static string $resource = PmbPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
