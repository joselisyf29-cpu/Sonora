<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $guarded = [];

    protected $casts = [
        'barras' => 'array',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}