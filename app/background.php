<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;

    protected $appends = [
        'full_path',
    ];

    protected $fillable = [
        'path'
    ];

    public function getFullPathAttribute()
    {
        return asset($this->path);
    }
}
