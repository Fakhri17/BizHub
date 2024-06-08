<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('List User')
                    ->columnSpan(2)
                    ->schema([
                        Forms\Components\TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->placeholder('Enter the username')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->placeholder('Enter the name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->placeholder('Enter the email')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone_number')
                            ->label('Phone Number')
                            ->required()
                            ->placeholder('Enter the phone number')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('address')
                            ->label('Address')
                            ->required()
                            ->placeholder('Enter the address')
                            ->maxLength(255),
                        // Forms\Components\Checkbox::make('is_published')
                        //     ->label('Is Published'),
                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                TextColumn::make('address')
                    ->label('Address')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                // CheckboxColumn::make('is_published')
                //     ->toggleable(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
