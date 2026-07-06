<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GameDetail extends Model
{
    protected $table = 'game_detail';

    protected $fillable = [
        'game_id',
        'name',
        'price',
        'label',
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
