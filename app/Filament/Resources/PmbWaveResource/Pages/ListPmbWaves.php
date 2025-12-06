<?php

namespace App\Filament\Resources\PmbWaveResource\Pages;

use App\Filament\Resources\PmbWaveResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPmbWaves extends ListRecords
{
    protected static string $resource = PmbWaveResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
