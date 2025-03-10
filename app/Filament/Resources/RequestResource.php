<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestResource\Pages;
use App\Filament\Resources\RequestResource\RelationManagers;
use App\Models\Address;
use App\Models\HandlingType;
use App\Models\Pet;
use App\Models\Request;
use App\Models\RequestType;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Select Request Type')
                    ->schema([
                        Select::make('request_type_id')
                            ->relationship('request_type', 'name')
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->live()
                    ]),
                Forms\Components\Section::make('Select Handling Type')
                    ->schema([
                        Select::make('handling_type_id')
                            ->options(fn ($get) => $get('request_type_id') ? RequestType::query()->find($get('request_type_id'))->handlingTypes()->pluck('name', 'id')->toArray() : [])
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->disabled(fn ($get) => !$get('request_type_id'))
                            ->live()
                    ])
                    ->description(fn ($get) => !$get('request_type_id') ? 'First Select Type' : null),
                Forms\Components\Section::make('Select Veterinarian')
                    ->visible(fn () => auth()->user()->hasRole(['developer', 'manager']))
                    ->schema([
                        Forms\Components\Select::make('veterinarian_id')
                            ->relationship('veterinarian', 'first_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                            ->native(false)
                            ->nullable()
                            ->searchable()
                            ->preload()
                    ]),
                Forms\Components\Section::make('Select User')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'first_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->live(),
                        Select::make('address_id')
                            ->options(fn ($get) => Address::query()->where('user_id', $get('user_id'))->pluck('name', 'id')->toArray())
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->live()
                            ->disabled(fn ($get) => !$get('user_id'))
                            ->helperText(fn ($get) => !$get('user_id') ? 'First Select User' : null),
                    ]),
                Forms\Components\Section::make('Select Pet')
                    ->schema([
                        Forms\Components\Select::make('pet_id')
                            ->options(fn ($get) => Pet::query()->where('user_id', $get('user_id'))->pluck('name', 'id')->toArray())
                            ->required()
                            ->native(false)
                            ->searchable()
                            ->preload()
                            ->disabled(fn ($get) => !$get('user_id'))
                            ->live(),
                    ])
                    ->description(fn ($get) => !$get('user_id') ? 'First Select a User' : null),
                Forms\Components\Section::make('Pricing')
                    ->schema([
                        TextInput::make('total_paid')
                            ->required()
                            ->integer()
                            ->prefix('تومان'),
                    ])->columns(3),
                Forms\Components\Section::make('Status')
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->native(false)
                            ->options([
                                'pending' => 'Pending',
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                                'completed' => 'Completed',
                                'canceled' => 'Canceled',
                            ]),
                        TextInput::make('description')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_emergency')
                    ]),
                Forms\Components\Section::make('Time')
                    ->schema([
                        Forms\Components\DateTimePicker::make('handling_date')
                            ->required()
                            ->minDate(now())
                    ])
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
                Tables\Columns\TextColumn::make('veterinarian.first_name')
                    ->getStateUsing(fn ($record) => $record->veterinarian ? $record->veterinarian->first_name . ' ' . $record->veterinarian->last_name : null)
                    ->default('No Veterinarian Accepted'),
                Tables\Columns\TextColumn::make('pet.name')
                    ->searchable()
                    ->prefix(function ($record){
                        return new HtmlString("<img src='{$record->pet->getFirstMediaUrl('avatar')}' style='width: 35px; height: 35px; border-radius: 50%; display: inline-block; margin-right: 10px'>");
                    }),
                Tables\Columns\TextColumn::make('request_type.name')
                    ->searchable(),
                Tables\Columns\SelectColumn::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                        'canceled' => 'Canceled',
                    ])
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->relationship('request_type', 'name')
                    ->multiple()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\Action::make('Accept')
                    ->label('Accept Request')
                    ->icon('heroicon-o-check-badge')
                    ->visible(fn ($record) => auth()->user()->can('accept-request') && is_null($record->veterinarian_id))
                    ->requiresConfirmation()
                    ->action(function ($record){
                        $record->update([
                            'veterinarian_id' => auth()->user()->id,
                        ]);
                    }),
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
            RelationManagers\ServicesRelationManager::make()
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('read-request');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(['read-request', 'create-request', 'edit-request', 'delete-request']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-request');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('edit-request');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete-request');
    }
}
