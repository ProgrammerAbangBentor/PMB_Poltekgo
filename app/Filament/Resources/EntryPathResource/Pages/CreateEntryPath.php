<?php

namespace App\Filament\Resources\EntryPathResource\Pages;

use App\Filament\Resources\EntryPathResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntryPath extends CreateRecord
{
    protected static string $resource = EntryPathResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
