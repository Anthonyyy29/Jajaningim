<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $table = 'table_games';
    protected $primaryKey = 'id_game';
    public $timestamps = false;
    protected $fillable = [
        'nama_game',
        'gambar_game',
        'deskripsi_game',
        'is_active'
    ];

    public function items(): HasMany
    {
        return $this->hasMany(GameItem::class, 'id_game', 'id_game');
    }




}
