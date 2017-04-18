<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function address()
    {
    return $this->hasMany('App\Models\Address');
    }

    public function userInfo(){
        return $this->hasMany('App\Models\UserInfo');
    }

    public function userOrder(){
        return $this->hasMany('App\Models\Order');
    }
}
