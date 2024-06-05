<?php

namespace App\Filament\Resources\UmkmProductResource\Pages;

use App\Filament\Resources\UmkmProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUmkmProducts extends ListRecords
{
    protected static string $resource = UmkmProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
