<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs\Tab;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationGroup = 'Blog';
    protected static ?string $navigationLabel = 'Blog List';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('Blog Information')
                    ->columnSpan(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->required()
                            ->placeholder('Enter the title of the blog'),



                        Select::make('blog_category_id')
                            ->label('Blog Category')
                            ->options(
                                BlogCategory::all()->pluck('name', 'id')
                            )
                            ->searchable()
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->disk('public')
                            ->directory('blog-thumbnails')
                            ->label('Thumbnail')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(1024)
                            ->imageEditor(),

                        RichEditor::make('content')
                            ->label('Content')
                            ->placeholder('Enter the content of the blog')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('blog-thumbnails')
                            ->columnSpanFull(),
                    ]),

                Section::make('Meta')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique()
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->placeholder('Enter the slug of the blog'),


                        CheckBox::make('is_published')
                            ->label('Is Published')
                            ->required(),
                    ]),



            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('blogCategory.name')
                    ->label('Blog Category')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                // thumbnail column
                ImageColumn::make('thumbnail'),
                // is_published column
                CheckboxColumn::make('is_published')
                ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->toggleable()
                    ->date()
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
