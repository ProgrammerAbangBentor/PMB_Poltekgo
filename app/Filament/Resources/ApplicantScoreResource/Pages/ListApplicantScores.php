<?php

namespace App\Filament\Resources\ApplicantScoreResource\Pages;

use App\Filament\Resources\ApplicantScoreResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApplicantScores extends ListRecords
{
    protected static string $resource = ApplicantScoreResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
