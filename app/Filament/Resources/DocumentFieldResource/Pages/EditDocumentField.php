<?php

namespace App\Filament\Resources\DocumentFieldResource\Pages;

use App\Filament\Resources\DocumentFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocumentField extends EditRecord
{
    protected static string $resource = DocumentFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
