<?php

namespace App\Filament\Resources\PetCategoryResource\Pages;

use App\Filament\Resources\PetCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePetCategory extends CreateRecord
{
    protected static string $resource = PetCategoryResource::class;
}
