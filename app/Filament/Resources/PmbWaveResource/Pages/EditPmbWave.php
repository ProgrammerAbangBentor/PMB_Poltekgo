<?php

namespace App\Filament\Resources\PmbWaveResource\Pages;

use App\Filament\Resources\PmbWaveResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPmbWave extends EditRecord
{
    protected static string $resource = PmbWaveResource::class;

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
