<?php

namespace App\Filament\Resources\PaymentMethods\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentMethodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('metode_payment')
                    ->required()
                    ->maxLength(50)
                    ->placeholder('QRIS, GoPay, DANA, dll'),
                TextInput::make('logo')
                    ->maxLength(100)
                    ->helperText('Nama file logo yang sudah ada di public/assets/component_logo/'),
                Select::make('is_active')
                    ->options(['true' => 'Aktif', 'false' => 'Nonaktif'])
                    ->default('true')
                    ->required(),
            ]);
    }
}
