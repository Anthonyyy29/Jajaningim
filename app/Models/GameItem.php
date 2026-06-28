<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class GameItem extends Model
{
    //
    protected $table = 'table_game_items';
    protected $primaryKey = 'id_item';
    public $timestamps = false;
    protected $fillable = [
        'label_item',
        'price',
        'type'
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'id_game', 'id_game');
    }

}
