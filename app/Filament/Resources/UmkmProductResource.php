<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UmkmProductResource\Pages;
use App\Filament\Resources\UmkmProductResource\RelationManagers;
use App\Models\UmkmProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UmkmProductResource extends Resource
{
    protected static ?string $model = UmkmProduct::class;

    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationLabel = 'UMKM Products';
    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListUmkmProducts::route('/'),
            'create' => Pages\CreateUmkmProduct::route('/create'),
            'edit' => Pages\EditUmkmProduct::route('/{record}/edit'),
        ];
    }
}
