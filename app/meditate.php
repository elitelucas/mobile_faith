<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meditate extends Model
{
    use HasFactory;

    protected $appends = [
        'image_full_path', 'audio_full_path'
    ];
    protected $casts = [
        'locked' => 'boolean',
    ];

    protected $fillable = [
        'title', 'description', 'image_path', 'audio_path', 'type', 'locked'
    ];

    public function getImageFullPathAttribute()
    {
        return asset($this->image_path);
    }

    public function getAudioFullPathAttribute()
    {
        return asset($this->audio_path);
    }
}
