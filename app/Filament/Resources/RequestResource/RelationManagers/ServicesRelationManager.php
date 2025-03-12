<?php

namespace App\Filament\Resources\RequestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class ServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'services';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('description')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->maxLength(255)
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ])
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ToggleColumn::make('is_paid')
                    ->afterStateUpdated(fn ($livewire) => $livewire->ownerRecord->update([
                        'status' => $livewire->ownerRecord->services()->wherePivot('is_paid', false)->exists() ? 'pending_pay' : null,
                    ]))
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => auth()->user()->can('create-service')),
                Tables\Actions\AttachAction::make()
                    ->preloadRecordSelect()
                    ->after(fn ($livewire) => $livewire->ownerRecord->update([
                        'status' => $livewire->ownerRecord->services()->wherePivot('is_paid', false)->exists() ? 'pending_pay' : null,
                    ]))
                    ->form(function ($action) {
                        return [
                          $action->getRecordSelect()->autofocus(),
                            Forms\Components\Toggle::make('is_paid')
                                ->after(fn ($livewire) => $livewire->ownerRecord->update([
                                    'status' => $livewire->ownerRecord->services()->wherePivot('is_paid', false)->exists() ? 'pending_pay' : null,
                                ]))
                        ];
                    }),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->after(fn ($livewire) => $livewire->ownerRecord->update([
                        'status' => $livewire->ownerRecord->services()->wherePivot('is_paid', false)->exists() ? 'pending_pay' : null,
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
