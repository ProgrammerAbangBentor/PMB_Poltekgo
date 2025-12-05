<?php

namespace App\Filament\Resources\DocumentFieldResource\Pages;

use App\Filament\Resources\DocumentFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocumentFields extends ListRecords
{
    protected static string $resource = DocumentFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
