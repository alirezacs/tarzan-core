<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Payed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'id')
                    ->required(),
                Forms\Components\TextInput::make('total_price')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_discount')
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('total_price')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_discount')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Information')
                    ->schema([
                        TextEntry::make('user.first_name')
                            ->url(fn ($record) => route('filament.admin.resources.users.edit', ['record' => $record->user->id]))
                            ->formatStateUsing(fn ($record) => $record->user->first_name . ' ' . $record->user->last_name)
                            ->openUrlInNewTab(true)
                            ->prefix(function ($record){
                                return new HtmlString("<img src='{$record->user->getFirstMediaUrl('avatar')}' style='width: 35px; height: 35px; border-radius: 50%; display: inline-block; margin-right: 10px'>");
                            }),
                        TextEntry::make('total_price'),
                        TextEntry::make('total_discount'),
                    ])
                    ->columns(3),
                Section::make('Order Items')
                    ->schema([
                        RepeatableEntry::make('orderItems')
                            ->schema([
                                TextEntry::make('productVariant.title')
                                    ->url(fn ($record) => route('filament.admin.resources.product-variants.edit', ['record' => $record->productVariant->id])),
                                TextEntry::make('total_price'),
                                TextEntry::make('quantity'),
                                TextEntry::make('total_discount'),
                            ])
                            ->columns(4)
                    ])
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }
}
