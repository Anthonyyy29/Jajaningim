<?php

namespace App\Filament\Resources\GameDetails\Pages;

use App\Filament\Resources\GameDetails\GameDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGameDetails extends ListRecords
{
    protected static string $resource = GameDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
