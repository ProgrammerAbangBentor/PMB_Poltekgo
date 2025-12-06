<?php

namespace App\Filament\Resources\EntryPathResource\Pages;

use App\Filament\Resources\EntryPathResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryPath extends EditRecord
{
    protected static string $resource = EntryPathResource::class;

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
