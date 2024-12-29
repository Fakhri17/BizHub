<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Section;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationGroup = 'UMKM';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Category Information')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('category_name')
                            ->label('Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->placeholder('Enter the slug of the blog'),
                        FileUpload::make('category_image')
                            ->disk('public')
                            ->directory('product-category-thumbnails')
                            ->label('Thumbnail')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(1024)
                            ->imageEditor(),
                        RichEditor::make('category_description')
                            ->maxLength(255)
                            ->default(null),
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),
                // ImageColumn::make('category_image'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->searchable()
                    ->date()
                    ->sortable(),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->extraAttributes(['data-id' => 'edit-action']),
                    Tables\Actions\ViewAction::make()
                        ->extraAttributes(['data-id' => 'view-action']),
                    Tables\Actions\DeleteAction::make()
                        ->extraAttributes(['data-id' => 'delete-action']),
                ])
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->extraAttributes(['data-id' => 'group-actions']),
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
