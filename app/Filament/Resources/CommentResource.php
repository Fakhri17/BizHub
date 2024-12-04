<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $navigationGroup = 'UMKM';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Comments on Products';
    protected static ?int $navigationSort = 2;



    // only comment in product umkm
    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        if ($user->hasRole('Super Admin')) {
            return parent::getEloquentQuery();
        }

        return parent::getEloquentQuery()->whereHas('umkmProduct', function ($query) use ($user) {
            $query->where('umkm_owner_id', $user->umkmOwner->id);
        });
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Comment Information')
                    ->columns(2)
                    ->schema([

                        // relation from user_id
                        TextInput::make('user.name')
                            ->label('Commentator')
                            ->readOnly()
                            ->placeholder(fn($record) => $record->user->name ?? 'No Commentator'),

                        // relation from umkm_product_id
                        TextInput::make('umkmProduct.product_name')
                            ->label('Product Name')
                            ->readOnly()
                            ->placeholder(fn($record) => $record->umkmProduct->product_name ?? 'No Product Name'),

                        TextInput::make('comment_text')
                            ->label('Comment Text')
                            ->placeholder('Enter your comment here')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('comment_text')
                    ->searchable()
                    ->label('Comment Text'),
                // relation from user_id
                TextColumn::make('user.name')
                    ->searchable()
                    ->label('Commentator'),
                // relation from umkm_product_id
                TextColumn::make('umkmProduct.product_name')
                    ->searchable()
                    ->label('Product Name'),

            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-o-adjustments-horizontal'),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
