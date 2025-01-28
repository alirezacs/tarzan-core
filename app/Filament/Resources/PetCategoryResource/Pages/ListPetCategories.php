<?php

namespace App\Filament\Resources\PetCategoryResource\Pages;

use App\Filament\Resources\PetCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPetCategories extends ListRecords
{
    protected static string $resource = PetCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
