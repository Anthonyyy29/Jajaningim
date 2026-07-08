<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'game_id',
        'game_detail_id',
        'payment_method_id',
        'form_data',
        'email',
        'amount',
        'status',
        'midtrans_snap_token',
    ];

    protected $casts = [
        'form_data' => 'array',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function gameDetail(): BelongsTo
    {
        return $this->belongsTo(GameDetail::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
