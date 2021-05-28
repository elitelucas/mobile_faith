<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bible extends Model
{
    use HasFactory;

    protected $fillable = [
        'language', 'damID', 'volume_name', 'bookID', 'chapterID', 'audio_path'
    ];

    protected $appends = [
        'full_path'
    ];

    public function getFullPathAttribute()
    {
        return asset($this->audio_path);
    }
}
