<?php

namespace App\Filament\Resources\PaymentManualResource\Pages;

use App\Filament\Resources\PaymentManualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentManuals extends ListRecords
{
    protected static string $resource = PaymentManualResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
