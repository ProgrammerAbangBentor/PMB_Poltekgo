<?php

namespace App\Filament\Resources\DocumentFieldResource\Pages;

use App\Filament\Resources\DocumentFieldResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocumentField extends CreateRecord
{
    protected static string $resource = DocumentFieldResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
