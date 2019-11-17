<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'age', 'gender', 'profile_image', 'cover_image', 'city', 'country', 'status', 'bio', 'email', 'password',
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

    public function friends() { return $this->hasMany('App\Friend'); }

    public function posts() { return $this->hasMany('App\Post'); }

    public function comments() { return $this->hasMany('App\Comment'); }

    public function likes() { return $this->hasMany('App\Like'); }

    public function galleries() { return $this->hasMany('App\Gallery'); }

    public function photos() { return $this->hasMany('App\Photo'); }

    public function notifications() { return $this->hasMany('App\Notification'); }

}

