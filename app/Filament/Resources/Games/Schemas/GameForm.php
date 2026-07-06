<?php

namespace App\Filament\Resources\Games\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class GameForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('image')
                    ->required()
                    ->maxLength(20)
                    ->helperText('Nama file gambar yang sudah ada di public/assets/logo_game/, contoh: mlbb.png'),
                TagsInput::make('form_fields')
                    ->required()
                    ->placeholder('user_id, server_id')
                    ->helperText('Field input yang ditampilkan di halaman game, misal: user_id, server_id'),
                Select::make('is_active')
                    ->options(['true' => 'Aktif', 'false' => 'Nonaktif'])
                    ->default('true'),
            ]);
    }
}
