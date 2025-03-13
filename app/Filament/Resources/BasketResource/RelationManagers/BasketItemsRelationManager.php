<?php

namespace App\Filament\Resources\BasketResource\RelationManagers;

use App\Models\BasketItem;
use App\Models\ProductVariant;
use App\Models\Request;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BasketItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'basketItems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Select Item')
                    ->schema([
                        Forms\Components\MorphToSelect::make('basketable')
                            ->types([
                                'ProductVariant' => Forms\Components\MorphToSelect\Type::make(ProductVariant::class)
                                    ->titleAttribute('title'),
                                'Request' => Forms\Components\MorphToSelect\Type::make(Request::class)
                                    ->titleAttribute('id')
                            ])
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                        TextInput::make('quantity')
                            ->hidden(fn (callable $get) => $get('basketable_type') !== 'App\Models\ProductVariant')
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('basketable_type')
                    ->label('Basket Item')
                    ->formatStateUsing(fn ($record) => $record->basketable_type === ProductVariant::class ? "(Product) {$record->basketable->title}" : "({$record->basketable->request_type->name} Request) {$record->id}"),
                TextColumn::make('total_price'),
                TextColumn::make('quantity'),
                TextColumn::make('total_discount'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function ($livewire, array $data) {
                        if(BasketItem::query()->where([
                            'basketable_id' => $data['basketable_id'],
                            'basket_id' => $livewire->ownerRecord->id,
                        ])->exists()) {
                            Notification::make('Error')
                                ->title('Item Already Exists')
                                ->danger()
                                ->send();
                            throw ValidationException::withMessages([
                                'email' => 'This email is already taken.',
                            ]);
                        }
                        if($data['basketable_type'] === 'App\Models\ProductVariant') {
                            $product = ProductVariant::query()->findOrFail($data['basketable_id']);
                            if($discount = $product->discount()->first()){
                                if($discount->discount_type == 'percent'){
                                    $data['total_discount'] = $data['quantity'] * ($product->price * $discount->discount_value) / 100;
                                    $data['total_price'] = $data['quantity'] * ($product->price - (($product->price * $discount->discount_value) / 100));
                                }else{
                                    $data['total_discount'] = $data['quantity'] * ($product->price - $discount->discount_value);
                                    $data['total_price'] = $data['quantity'] * ($product->price - $discount->discount_value);
                                }
                            }else{
                                $data['total_price'] = $product->price;
                            }
                        }else{
                            $data['quantity'] = 1;
                            $request = Request::query()->findOrFail($data['basketable_id']);
                            $data['total_price'] = $request->request_type->min_price;
                        }

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
