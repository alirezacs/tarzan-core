<?php

namespace App\Filament\Resources\PetCategoryResource\Pages;

use App\Filament\Resources\PetCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPetCategory extends EditRecord
{
    protected static string $resource = PetCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
