<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmOwnerResource\Pages;
use App\Filament\Resources\UmkmOwnerResource\RelationManagers;
use App\Models\UmkmOwner;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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

class UmkmOwnerResource extends Resource
{
    protected static ?string $model = UmkmOwner::class;

    protected static ?string $navigationGroup = 'UMKM';
    protected static ?string $navigationLabel = 'Umkm Owner';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function create(User $user): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Information')
                    ->columnSpan(2)
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->options(
                                User::all()->pluck('name', 'id')
                            )
                            ->searchable()
                            ->required(),
                        TextInput::make('npwp')
                            ->label('NPWP')
                            ->required()
                            ->placeholder('Enter the NPWP of the UMKM Owner'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                TextColumn::make('npwp')
                    ->label('NPWP')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Add any filters if necessary
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListUmkmOwners::route('/'),
            'create' => Pages\CreateUmkmOwner::route('/create'),
            'edit' => Pages\EditUmkmOwner::route('/{record}/edit'),
        ];
    }
}
