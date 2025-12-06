<?php

namespace App\Filament\Resources\PmbPeriodResource\Pages;

use App\Filament\Resources\PmbPeriodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPmbPeriods extends ListRecords
{
    protected static string $resource = PmbPeriodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
