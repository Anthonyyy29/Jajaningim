<?php

namespace App\Filament\Resources\GameDetails\Pages;

use App\Filament\Resources\GameDetails\GameDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGameDetail extends EditRecord
{
    protected static string $resource = GameDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
