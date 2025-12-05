<?php

namespace App\Filament\Resources\BiodataFieldResource\Pages;

use App\Filament\Resources\BiodataFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBiodataFields extends ListRecords
{
    protected static string $resource = BiodataFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
