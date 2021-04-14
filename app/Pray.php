<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Following;

class Pray extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    protected $appends = [
        'user','followers'
    ];

    public function getUserAttribute()
    {
        return User::select('id','name')->find($this->user_id);
    }

    public function getFollowersAttribute()
    {
        return Following::where('pray_id',$this->id)->pluck('user_id');
    }
}
