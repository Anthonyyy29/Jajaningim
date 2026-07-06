<?php

namespace App\Filament\Resources\GameDetails;

use App\Filament\Resources\GameDetails\Pages\CreateGameDetail;
use App\Filament\Resources\GameDetails\Pages\EditGameDetail;
use App\Filament\Resources\GameDetails\Pages\ListGameDetails;
use App\Filament\Resources\GameDetails\Schemas\GameDetailForm;
use App\Filament\Resources\GameDetails\Tables\GameDetailsTable;
use App\Models\GameDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GameDetailResource extends Resource
{
    protected static ?string $model = GameDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return GameDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GameDetailsTable::configure($table);
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
            'index' => ListGameDetails::route('/'),
            'create' => CreateGameDetail::route('/create'),
            'edit' => EditGameDetail::route('/{record}/edit'),
        ];
    }
}
