<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use App\Filament\Resources\TransactionResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        /* Make Zarinpal */
        try {
            $zarinpal = zarinpal()
                ->amount($data['amount'])
                ->request()
                ->description('درخواست خدمات پزشکی از تارزان')
                ->callbackUrl(route('basket.verify'))
                ->send();
            if(!$zarinpal->success()){
                // todo event
                Notification::make('Error')
                    ->title('Error In Make Payment')
                    ->danger()
                    ->send();
                throw ValidationException::withMessages(['Error In Make Payment']);
            }
            $data['link'] = $zarinpal->url();
            $data['authority'] = $zarinpal->authority();
            $data['fee'] = $zarinpal->fee();
            $data['fee_type'] = $zarinpal->feeType();
        }catch (\Exception $e){
            // todo Event
            throw ValidationException::withMessages(['Error In Make Payment']);
        }
        /* Make Zarinpal */

        return $data;
    }
}
