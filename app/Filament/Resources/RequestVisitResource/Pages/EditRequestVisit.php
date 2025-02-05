<?php

namespace App\Filament\Resources\RequestVisitResource\Pages;

use App\Filament\Resources\RequestVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestVisit extends EditRecord
{
    protected static string $resource = RequestVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
