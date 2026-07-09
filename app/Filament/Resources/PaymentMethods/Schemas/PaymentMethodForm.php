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
                Select::make('midtrans_code')
                    ->label('Kode Midtrans (enabled_payments)')
                    ->options([
                        'other_qris' => 'QRIS (other_qris)',
                        'gopay' => 'GoPay (gopay)',
                        'shopeepay' => 'ShopeePay (shopeepay)',
                        'dana' => 'DANA (dana)',
                        'ovo' => 'OVO (ovo)',
                        'credit_card' => 'Kartu Kredit/Debit (credit_card)',
                        'bca_va' => 'BCA Virtual Account (bca_va)',
                        'bni_va' => 'BNI Virtual Account (bni_va)',
                        'bri_va' => 'BRI Virtual Account (bri_va)',
                        'permata_va' => 'Permata Virtual Account (permata_va)',
                        'echannel' => 'Mandiri Bill Payment (echannel)',
                        'alfamart' => 'Alfamart (alfamart)',
                        'indomaret' => 'Indomaret (indomaret)',
                    ])
                    ->searchable()
                    ->helperText('Wajib diisi sesuai kode Snap enabled_payments Midtrans, kalau kosong checkout untuk metode ini akan gagal (lihat docs.midtrans.com).')
                    ->required(),
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
