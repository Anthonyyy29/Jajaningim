<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order')
                    ->columns(2)
                    ->components([
                        TextEntry::make('order_id')
                            ->label('Order ID')
                            ->copyable(),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'paid' => 'success',
                                'pending' => 'warning',
                                'failed', 'expired' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('game.name')
                            ->label('Game'),
                        TextEntry::make('gameDetail.name')
                            ->label('Item'),
                        TextEntry::make('paymentMethod.metode_payment')
                            ->label('Metode Bayar'),
                        TextEntry::make('amount')
                            ->label('Jumlah')
                            ->money('idr'),
                        TextEntry::make('email')
                            ->label('Email'),
                        TextEntry::make('midtrans_snap_token')
                            ->label('Snap Token')
                            ->copyable()
                            ->placeholder('—'),
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y H:i'),
                        TextEntry::make('updated_at')
                            ->label('Terakhir diperbarui')
                            ->dateTime('d M Y H:i'),
                    ]),
                Section::make('Data Form Customer')
                    ->components([
                        TextEntry::make('form_data')
                            ->label('')
                            ->formatStateUsing(fn (?array $state) => collect($state ?? [])
                                ->map(fn ($value, $key) => "{$key}: {$value}")
                                ->implode(', ') ?: '—'),
                    ]),
            ]);
    }
}
