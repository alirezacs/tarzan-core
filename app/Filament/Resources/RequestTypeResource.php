<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestTypeResource\Pages;
use App\Filament\Resources\RequestTypeResource\RelationManagers;
use App\Models\HandlingType;
use App\Models\Request;
use App\Models\RequestType;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestTypeResource extends Resource
{
    protected static ?string $model = RequestType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')
                    ->schema([
                        Forms\Components\Section::make('Information')
                            ->schema([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('description')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Toggle::make('is_active')
                                    ->required(),
                            ]),
                        Forms\Components\Section::make('Pricing')
                            ->schema([
                                TextInput::make('min_price')
                                    ->required()
                                    ->integer()
                                    ->minValue(0),
                                TextInput::make('max_price')
                                    ->required()
                                    ->integer()
                                    ->minValue(function ($get){
                                        return $get('min_price');
                                    }),
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('description')
                    ->limit(25),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()
                    ->modalDescription('Are You Sure? This Action May Delete All Requests With This Type. Delete?')
                    ->before(function ($record){
                        $record->requests()->delete();
                    }),
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
            RelationManagers\HandlingTypesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequestTypes::route('/'),
            'create' => Pages\CreateRequestType::route('/create'),
            'edit' => Pages\EditRequestType::route('/{record}/edit'),
        ];
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('read-request_type');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(['read-request_type', 'create-request_type', 'edit-request_type', 'delete-request_type']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-request_type');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('edit-request_type');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete-request_type');
    }
}
