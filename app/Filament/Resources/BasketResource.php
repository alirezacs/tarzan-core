<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BasketResource\Pages;
use App\Filament\Resources\BasketResource\RelationManagers;
use App\Models\Basket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BasketResource extends Resource
{
    protected static ?string $model = Basket::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Payed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record): string => $record->first_name . ' ' . $record->last_name)
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->disabledOn('edit'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\BasketItemsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBaskets::route('/'),
            'create' => Pages\CreateBasket::route('/create'),
            'edit' => Pages\EditBasket::route('/{record}/edit'),
        ];
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('read-basket');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(['read-basket']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-basket');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('edit-basket');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete-basket');
    }
}
