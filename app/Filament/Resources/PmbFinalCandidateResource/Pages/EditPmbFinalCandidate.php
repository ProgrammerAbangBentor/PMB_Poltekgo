<?php

namespace App\Filament\Resources\PmbFinalCandidateResource\Pages;

use App\Filament\Resources\PmbFinalCandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPmbFinalCandidate extends EditRecord
{
    protected static string $resource = PmbFinalCandidateResource::class;

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
