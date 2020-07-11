<?php

namespace App;

// use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Event;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //  public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    //  public function getJWTCustomClaims()
    // {
    //     return [];
    // }


     public function events()
    {
        return $this->hasMany('App\Event');
    }
}
