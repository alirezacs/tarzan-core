<?php

namespace App\Filament\Resources\RequestVisitResource\Pages;

use App\Filament\Resources\RequestVisitResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRequestVisit extends CreateRecord
{
    protected static string $resource = RequestVisitResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['request_type_id'] = '679f7d8c9045d8a7af063473';
        return $data;
    }
}
