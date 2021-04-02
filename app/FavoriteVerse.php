<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteVerse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'text', 'reference'
    ];

    protected $appends = [
        'path'
    ];

    public function getPathAttribute()
    {
        return Background::inRandomOrder()->first()->full_path;
    }
}
