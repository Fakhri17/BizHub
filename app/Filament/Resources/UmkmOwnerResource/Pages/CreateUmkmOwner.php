<?php

namespace App\Filament\Resources\UmkmOwnerResource\Pages;

use App\Filament\Resources\UmkmOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUmkmOwner extends CreateRecord
{
    protected static string $resource = UmkmOwnerResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
