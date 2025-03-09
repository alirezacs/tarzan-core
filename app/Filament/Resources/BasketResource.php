<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BasketResource\Pages;
use App\Filament\Resources\BasketResource\RelationManagers;
use App\Filament\Resources\BasketResource\RelationManagers\BasketItemsRelationManager;
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

    protected static ?string $navigationGroup = 'Baskets';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->required()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.first_name')
                    ->formatStateUsing(fn ($record) => $record->user->first_name . ' ' . $record->user->last_name)
                    ->searchable(),
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
            BasketItemsRelationManager::class
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
        return auth()->user()->can(['read-basket', 'create-basket', 'edit-basket', 'delete-basket']);
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
