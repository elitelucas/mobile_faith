<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'deviceToken', 'fbID', 'googleID', 'appleID', 'damID', 'lastPray',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'is_admin',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [       
        'email_verified_at' => 'datetime',
        'religionID' => 'integer',
        'enablePush' => 'boolean',
        'enableEmail' => 'boolean',
        'paid' => 'boolean',
    ];

    /*Login with Socialite*/
    public function socialProviders()
    {
        return $this->hasMany(socialProvider::class);
    }
}
