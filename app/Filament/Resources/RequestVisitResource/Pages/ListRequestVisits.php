<?php

namespace App\Filament\Resources\RequestVisitResource\Pages;

use App\Filament\Resources\RequestVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestVisits extends ListRecords
{
    protected static string $resource = RequestVisitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
