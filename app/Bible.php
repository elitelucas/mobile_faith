<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bible extends Model
{
    use HasFactory;

    protected $fillable = [
        'language', 'damID', 'bookID', 'chapterID','audio_path'
    ]; 
}
