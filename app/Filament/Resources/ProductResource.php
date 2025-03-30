<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Store';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('body')
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->required(),
                    ]),
                Forms\Components\Section::make('Select Category')
                    ->schema([
                        Forms\Components\Select::make('Category')
                            ->relationship('ProductCategory', 'name')
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                    ]),
                Forms\Components\Section::make('Select Brand')
                    ->schema([
                        Forms\Components\Select::make('Brand')
                            ->relationship('Brand', 'name')
                            ->required()
                            ->native(false)
                            ->preload()
                            ->searchable()
                    ]),
                Forms\Components\Section::make('Images Upload')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->required()
                            ->imageEditor(),
                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->required()
                            ->multiple()
                            ->imageEditor()
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\TextColumn::make('ProductCategory.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Brand.name')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('visited_counts'),
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
            RelationManagers\ProductVariantsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function canView(Model $record): bool
    {
        return auth()->user()->can('read-product');
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->can(['read-product']);
    }

    public static function canCreate(): bool
    {
        return auth()->user()->can('create-product');
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()->can('edit-product');
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()->can('delete-product');
    }
}
