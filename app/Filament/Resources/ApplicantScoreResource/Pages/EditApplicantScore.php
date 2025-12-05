<?php

namespace App\Filament\Resources\ApplicantScoreResource\Pages;

use App\Filament\Resources\ApplicantScoreResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApplicantScore extends EditRecord
{
    protected static string $resource = ApplicantScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
