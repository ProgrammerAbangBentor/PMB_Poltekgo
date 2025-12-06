<?php

namespace App\Filament\Resources\EntryPathResource\Pages;

use App\Filament\Resources\EntryPathResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntryPaths extends ListRecords
{
    protected static string $resource = EntryPathResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
