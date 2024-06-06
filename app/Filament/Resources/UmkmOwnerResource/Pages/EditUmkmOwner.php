<?php

namespace App\Filament\Resources\UmkmOwnerResource\Pages;

use App\Filament\Resources\UmkmOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUmkmOwner extends EditRecord
{
    protected static string $resource = UmkmOwnerResource::class;
    

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
