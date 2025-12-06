<?php

namespace App\Filament\Resources\PmbFinalCandidateResource\Pages;

use App\Filament\Resources\PmbFinalCandidateResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPmbFinalCandidates extends ListRecords
{
    protected static string $resource = PmbFinalCandidateResource::class;

   protected function getHeaderActions(): array
    {
        return [];
    }
}
