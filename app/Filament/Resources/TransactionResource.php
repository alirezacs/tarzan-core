<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use function Symfony\Component\String\s;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Payed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->maxLength(255)
                    ->minValue(1000)
                    ->integer(),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.first_name')
                    ->formatStateUsing(fn ($record) => $record->user->first_name . ' ' . $record->user->last_name)
                    ->searchable()
                    ->prefix(function ($record){
                        return new HtmlString("<img src='{$record->user->getFirstMediaUrl('avatar')}' style='width: 35px; height: 35px; border-radius: 50%; display: inline-block; margin-right: 10px'>");
                    }),
                TextColumn::make('link')
                    ->url(fn ($record) => $record->link),
                Tables\Columns\TextColumn::make('amount')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(function ($record) {
                        switch ($record->status) {
                            case 'payed':
                                return 'success';
                                break;
                            case 'pending':
                                return 'warning';
                                break;
                            case 'cancelled':
                                return 'danger';
                                break;
                        }
                    }),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('user.first_name')
                ->prefix(function ($record){
                    return new HtmlString("<img src='{$record->user->getFirstMediaUrl('avatar')}' style='width: 35px; height: 35px; border-radius: 50%; display: inline-block; margin-right: 10px'>");
                })
                ->getStateUsing(fn ($record) => $record->user->first_name . ' ' . $record->user->last_name),
            TextEntry::make('amount')
                ->prefix('Amount: '),
            TextEntry::make('fee'),
            TextEntry::make('fee_type'),
            TextEntry::make('code'),
            TextEntry::make('status'),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('read-transaction');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(['read-transaction']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-transaction');
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete-transaction');
    }
}
