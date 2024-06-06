<?php

namespace App\Filament\Resources\UmkmOwnerResource\Pages;

use App\Filament\Resources\UmkmOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUmkmOwners extends ListRecords
{
    protected static string $resource = UmkmOwnerResource::class;

    protected function canCreate(): bool
    {
        return false;
    }
}
