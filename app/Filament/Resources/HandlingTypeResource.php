<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HandlingTypeResource\Pages;
use App\Filament\Resources\HandlingTypeResource\RelationManagers;
use App\Models\HandlingType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HandlingTypeResource extends Resource
{
    protected static ?string $model = HandlingType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHandlingTypes::route('/'),
            'create' => Pages\CreateHandlingType::route('/create'),
            'edit' => Pages\EditHandlingType::route('/{record}/edit'),
        ];
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('read-handling_type');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(['read-handling_type', 'create-handling_type', 'edit-handling_type', 'delete-handling_type']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-handling_type');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('edit-handling_type');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete-handling_type');
    }
}
