<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductVariantsRelationManager extends RelationManager
{
    protected static string $relationship = 'product_variants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Select Color')
                    ->schema([
                        Forms\Components\Select::make('color_id')
                            ->relationship('Color', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('description')
                                    ->maxLength(255),
                                Forms\Components\ColorPicker::make('rgb')
                                    ->required(),
                                Forms\Components\Toggle::make('is_active')
                                    ->required(),
                            ])
                    ]),
                Forms\Components\Section::make('Select Size')
                    ->schema([
                        Forms\Components\Select::make('size_id')
                            ->relationship('Size', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('description')
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('is_active')
                                    ->required(),
                            ])
                    ]),
                Forms\Components\Section::make('Select Discount')
                    ->schema([
                        Forms\Components\Select::make('discount_id')
                            ->relationship('discount', 'title')
                            ->native(false)
                            ->searchable()
                            ->preload()
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
