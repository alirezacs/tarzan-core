<?php

namespace App\Filament\Resources\HandlingTypeResource\Pages;

use App\Filament\Resources\HandlingTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHandlingTypes extends ListRecords
{
    protected static string $resource = HandlingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
