<?php

namespace App\Filament\Resources\PaymentManualResource\Pages;

use App\Filament\Resources\PaymentManualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentManual extends EditRecord
{
    protected static string $resource = PaymentManualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
