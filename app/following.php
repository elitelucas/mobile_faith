<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pray_id', 'user_id'
    ];
    
    protected $casts = [
        'pray_id' => 'integer',
        'user_id' => 'integer',
    ];
}
