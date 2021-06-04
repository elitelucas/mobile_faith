<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meditate extends Model
{
    use HasFactory;

    protected $appends = [
        'thumbnail_full_path', 'image_full_path', 'audio_full_path'
    ];

    protected $casts = [
        'title' => 'array',
        'locked' => 'boolean',
    ];

    protected $fillable = [
        'title', 'thumbnail_path', 'image_path', 'audio_path',  'locked'
    ];

    public function getImageFullPathAttribute()
    {
        return asset($this->image_path);
    }

    public function getThumbnailFullPathAttribute()
    {
        return asset($this->thumbnail_path);
    }

    public function getAudioFullPathAttribute()
    {
        return asset($this->audio_path);
    }
}
