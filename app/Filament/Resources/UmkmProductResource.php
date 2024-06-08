<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\UmkmOwner;
use Filament\Tables\Table;
use App\Models\UmkmProduct;
use App\Models\ProductCategory;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Filament\Forms\Components\Builder as Builder;
use Filament\Tables\Columns\CheckboxColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UmkmProductResource\Pages;
use App\Filament\Resources\UmkmProductResource\RelationManagers;
use Filament\Support\RawJs;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TagsInput;
use Guava\FilamentIconPicker\Forms\IconPicker;





class UmkmProductResource extends Resource
{
    protected static ?string $model = UmkmProduct::class;

    protected static ?string $navigationGroup = 'UMKM';
    protected static ?string $navigationLabel = 'UMKM Product List';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function getNavigationBadge(): ?string
    {
        $user = auth()->user();
        if ($user->hasRole('Super Admin')) {
            return UmkmProduct::count();
        } else {
            return UmkmProduct::where('umkm_owner_id', $user->umkmOwner->id)->count();
        }
    }

    public static function getEloquentQuery(): EloquentBuilder
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return parent::getEloquentQuery();
        } else {
            $umkmOwnerId = $user->umkmOwner->id;
            return parent::getEloquentQuery()->where('umkm_owner_id', $umkmOwnerId);
        }
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                //
                Section::make('Umkm Product Information')
                    ->columnSpan(2)
                    ->schema([
                        Hidden::make('umkm_owner_id')
                            ->default(auth()->user()->hasRole('Super Admin') ? null : auth()->user()->umkmOwner->id),

                        TextInput::make('product_name')
                            ->label('Product Name')
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }

                                $set('slug', Str::slug($state));
                            })
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter the name of the product'),

                        Select::make('product_category_id')
                            ->label('Product Category')
                            ->options(
                                ProductCategory::all()->pluck('category_name', 'id')
                            )
                            ->searchable()
                            ->required(),

                        FileUpload::make('product_image')
                            ->disk('public')
                            ->directory('product-thumbnails')
                            ->label('Product Image')
                            ->image()
                            ->acceptedFileTypes(['image/*'])
                            ->maxSize(1024)
                            ->imageEditor(),

                        TextInput::make('product_price')
                            ->label('Product Price')
                            ->mask(RawJs::make('$money($input)'))
                            ->stripCharacters(',')
                            ->numeric()
                            ->required(),

                        RichEditor::make('product_description')
                            ->label('Product Description')
                            ->placeholder('Enter the description of the product')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('product-thumbnails')
                            ->columnSpanFull()
                            ->required(),

                        TextInput::make('product_location')
                            ->label('Product Location')
                            ->required()
                            ->placeholder('Enter the location of the product'),

                        Builder::make('product_gallery')
                            ->label('Product Gallery')
                            ->collapseAllAction(
                                fn (Action $action) => $action->label('Collapse all content'),
                            )
                            ->blocks([
                                Builder\Block::make('Image')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('Image')
                                            ->image()
                                            ->acceptedFileTypes(['image/*'])
                                            ->maxSize(1024)
                                            ->imageEditor(),
                                    ]),
                            ])
                            ->collapsible()
                            ->collapsed()
                            ->collapseAllAction(
                                fn (Action $action) => $action->label('Collapse all content'),
                            ),

                        // Builder::make('product_social_media')



                    ]),

                Section::make('Meta')
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('product_location')
                            ->label('Product Location')
                            ->required()
                            ->placeholder('Enter the location of the product'),

                        // TextInput::make('product_social_media')
                        //     ->label('Product Social Media'),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')
                            ->placeholder('Enter the slug of the blog'),

                        TagsInput::make('tags')
                            ->separator(','),

                        Builder::make('product_social_media')
                            ->label('Product Social Media')

                            ->blocks([
                                Builder\Block::make('Social Media')
                                    ->columns(1)
                                    ->schema([
                                        IconPicker::make('icon')
                                            ->sets(['tabler']),

                                        TextInput::make('username')
                                            ->label('Username')
                                            ->required(),
                                        TextInput::make('url')
                                            ->label('URL')
                                            ->url()
                                            ->columnSpanFull()
                                            ->required(),
                                    ]),
                            ])
                            ->collapsible()
                            ->collapsed()
                            ->collapseAllAction(
                                fn (Action $action) => $action->label('Collapse all content'),
                            ),

                        CheckBox::make('is_published')
                            ->label('Is Published'),
                        // ->required(),
                    ]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('umkmOwner.id')
                //     ->label('Owner Id')
                //     ->numeric()
                //     ->sortable(),
                TextColumn::make('product_name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                ImageColumn::make('product_image'),
                // ImageColumn::make('product_gallery'),
                TextColumn::make('product_price')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('productCategory.category_name')
                    ->label('Product Category')
                    ->numeric()
                    ->sortable(),
                // TextColumn::make('product_location')
                //     ->searchable(),
                IconColumn::make('is_published')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->toggleable()
                    ->date()
                    ->searchable()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
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



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUmkmProducts::route('/'),
            'create' => Pages\CreateUmkmProduct::route('/create'),
            'edit' => Pages\EditUmkmProduct::route('/{record}/edit'),
        ];
    }
}
