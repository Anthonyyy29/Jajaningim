<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $primaryKey = 'id_games';
    protected $fillable = ['name', 'image'];

}
