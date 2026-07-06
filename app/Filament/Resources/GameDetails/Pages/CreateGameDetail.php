<?php

namespace App\Filament\Resources\GameDetails\Pages;

use App\Filament\Resources\GameDetails\GameDetailResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGameDetail extends CreateRecord
{
    protected static string $resource = GameDetailResource::class;
}
