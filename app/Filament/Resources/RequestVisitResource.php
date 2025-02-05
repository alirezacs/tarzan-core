<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestVisitResource\Pages;
use App\Filament\Resources\RequestVisitResource\RelationManagers;
use App\Models\Address;
use App\Models\HandlingType;
use App\Models\Pet;
use App\Models\Request;
use App\Models\RequestType;
use Dotswan\MapPicker\Fields\Map;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class RequestVisitResource extends Resource
{
    protected static string $type = 'visit';
    protected static ?string $model = Request::class;

    protected static ?string $navigationLabel = 'Visit Requests';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Requests';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('requestType', function (Builder $query) {
            $query->where('name', 'visit')->where('is_active', true);
        });
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Select User')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'first_name')
                            ->getOptionLabelFromRecordUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->live()
                    ]),
                Forms\Components\Section::make('Select Pet')
                    ->schema([
                        Select::make('pet_id')
                            ->relationship('pet', 'name')
                            ->disabled(fn ($get) => !$get('user_id'))
                            ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->id})")
                            ->required()
                            ->options(function ($get){
                                return Pet::query()
                                    ->where('user_id', $get('user_id'))
                                    ->pluck('name', 'id')
                                    ->toArray();
                            })
                            ->native(false)
                            ->preload()
                            ->searchable()
                    ])
                    ->description(fn ($get) => !$get('user_id') ? 'First Select User' : null),
                Forms\Components\Section::make('Select Handling Type')
                    ->schema([
                        Select::make('handling_type_id')
                            ->options(function (){
                                return RequestType::query()->where('name', self::$type)->firstOrFail()->handlingType;
                            })
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                    ]),
                Forms\Components\Section::make('Select Status')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                                'canceled' => 'Canceled',
                            ])
                            ->required()
                            ->native(false)
                    ]),
                Forms\Components\Section::make('Request Details')
                    ->schema([
                        TextInput::make('description')
                            ->maxLength(255),
                        Forms\Components\Section::make('Select Address')
                            ->schema([
                                Select::make('address_id')
                                    ->required()
                                    ->label('Address')
                                    ->disabled(fn ($get) => !$get('user_id'))
                                    ->reactive()
                                    ->options(function ($get){
                                        return Address::query()
                                                ->where('user_id', $get('user_id'))
                                                ->pluck('name', 'id')
                                                ->toArray();
                                    })
                                    ->live()
                                    ->native(false)
                                    ->preload()
                                    ->searchable()
                            ])
                            ->description(fn ($get) => !$get('user_id') ? 'First Select User' : null),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user')
                    ->formatStateUsing(fn ($record) => $record->user->first_name . ' ' . $record->user->last_name)
                    ->prefix(function ($record){
                        return new HtmlString("<img src='{$record->user->getFirstMediaUrl('avatar')}' style='width: 40px; height: 40px; border-radius: 50%; display: inline-block; margin-right: 10px'>");
                    }),
                TextColumn::make('pet.name')
                    ->prefix(function ($record){
                        return new HtmlString("<img src='{$record->pet->getFirstMediaUrl('avatar')}' style='width: 40px; height: 40px; border-radius: 50%; display: inline-block; margin-right: 10px'>");
                    })
                    ->html(),
                TextColumn::make('status'),
                TextColumn::make('handlingType.name')
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListRequestVisits::route('/'),
            'create' => Pages\CreateRequestVisit::route('/create'),
            'edit' => Pages\EditRequestVisit::route('/{record}/edit'),
        ];
    }
}
