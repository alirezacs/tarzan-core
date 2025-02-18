<?php

namespace App\Filament\Resources\BasketResource\RelationManagers;

use App\Models\ProductVariant;
use App\Models\Request;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Components\Tab;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

class BasketItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'basketItems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')
                    ->schema([
                        Select::make('product_variant_id')
                            ->required()
                            ->relationship('productVariant', 'title', fn (Builder $query) => $query->where('is_active', true)->where('stock', '>', 0))
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->live(),
                        Forms\Components\TextInput::make('quantity')
                            ->integer()
                            ->required()
                            ->minLength(1)
                            ->maxLength(fn ($get) => ProductVariant::query()->find($get('product_variant_id'))->stock ?? 1)
                            ->live()
                            ->disabled(fn ($get) => !$get('product_variant_id')),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('productVariant.product.thumbnail')
                    ->collection('thumbnail'),
                Tables\Columns\TextColumn::make('productVariant.title'),
                TextColumn::make('total_price'),
                TextColumn::make('total_discount'),
                TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function ($data) {
                        $productVariant = ProductVariant::query()->find($data['product_variant_id']);
                        $data['total_discount'] = 0;
                        if($productVariant->discount) {
                            if($productVariant->discount->discount_type == 'amount') {
                                $data['total_discount'] = $productVariant - $productVariant->discount->discount_value;
                            }else{
                                $data['total_discount'] = $productVariant->price - (($productVariant->price * $productVariant->discount->discount_value) / 100);
                            }
                        }
                        $data['total_price'] = $data['quantity'] * ($productVariant->price - $data['total_discount']);

                        return $data;
                    })
                    ->before(function ($data, $livewire){
                        $user = User::query()->find($livewire->ownerRecord['user_id']);
                        if($user->basket->basketItems->where('product_variant_id', $data['product_variant_id'])->count()) {
                            Notification::make()
                                ->title('Exists Product')
                                ->body('Selected Product Already Exists In Your Basket')
                                ->danger()
                                ->send();
                            throw ValidationException::withMessages(['Selected Product Already Exists In Your Basket']);

                        }
                    })
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
