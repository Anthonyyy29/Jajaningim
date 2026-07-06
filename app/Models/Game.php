<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'form_fields',
        'is_active',
    ];

    protected $casts = [
        'form_fields' => 'array',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(GameDetail::class);
    }
}
