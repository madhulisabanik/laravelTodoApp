<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Learning accessor
     * 
     * @param string $name
     * @return string
     */

    // public function getNameAttribute($name){
    //     return "My name is: ". strtoupper($name);
    // }

    /**
     * Learning mutator
     * 
     * @param string $name
     * @return string
     */

    // public function setPasswordAttribute($password){
    //     $this->attributes['password'] = bcrypt($password);
    // }
}
