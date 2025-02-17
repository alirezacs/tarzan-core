<?php

namespace App\Filament\Resources\BasketResource\RelationManagers;

use App\Models\ProductVariant;
use App\Models\Request;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Components\Tab;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                            ->relationship('productVariant', 'title', fn ($query) => $query->where('is_active', true)->where('stock', '>', 0))
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
                Tables\Columns\TextColumn::make('productVariant.title'),
                TextColumn::make('total_price'),
                TextColumn::make('quantity'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function ($data) {
                        $productVariant = ProductVariant::query()->find($data['product_variant_id']);
                        $data['total_price'] = 9998;
                        $data['total_discount'] = 958;

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
