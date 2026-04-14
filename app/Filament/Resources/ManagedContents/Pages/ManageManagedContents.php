<?php

namespace App\Filament\Resources\ManagedContents\Pages;

use App\Filament\Resources\ManagedContents\ManagedContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageManagedContents extends ManageRecords
{
    protected static string $resource = ManagedContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
