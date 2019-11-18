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

    public static function usersList($loggedInUser) 
    {
        return DB::table('users AS u')
            ->leftJoin('friends AS f1', 'u.id', '=', 'f1.friend_id')
            ->leftJoin('friends AS f2', 'u.id', '=', 'f2.user_id')
            ->where('u.id', '!=', $loggedInUser)
            ->selectRaw('u.id, u.firstname, u.lastname, u.profile_image, u.city, u.country, u.status,
                CASE WHEN (f1.id IS NOT NULL AND f1.user_id = '.$loggedInUser.' AND f1.approved = 1) THEN 1 ELSE 0 END AS isFollowed,
                CASE WHEN (f1.id IS NOT NULL AND f1.user_id = '.$loggedInUser.' AND f1.approved = 0) THEN 1 ELSE 0 END AS isLoggedinUserRequestPending,
                CASE WHEN (f2.id IS NOT NULL AND f2.friend_id = '.$loggedInUser.' AND f2.approved = 0) THEN 1 ELSE 0 END AS isUserRequestPending  
                ')
            ->orderBy('id', 'DESC')
            ->get();
    }

    public static function findUser($search, $loggedInUser)
    {
        return DB::table('users AS u')
            ->leftJoin('friends AS f1', 'u.id', '=', 'f1.friend_id')
            ->leftJoin('friends AS f2', 'u.id', '=', 'f2.user_id')
            ->where('u.firstname', 'LIKE', '%'.$search[0].'%')
            ->orWhere('u.lastname', 'LIKE', '%'.$search[1].'%')
            ->selectRaw('u.id, u.firstname, u.lastname, u.profile_image, u.city, u.country, u.status,
                CASE WHEN (f1.id IS NOT NULL AND f1.user_id = '.$loggedInUser.' AND f1.approved = 1) THEN 1 ELSE 0 END AS isFollowed,
                CASE WHEN (f1.id IS NOT NULL AND f1.user_id = '.$loggedInUser.' AND f1.approved = 0) THEN 1 ELSE 0 END AS isLoggedinUserRequestPending,
                CASE WHEN (f2.id IS NOT NULL AND f2.friend_id = '.$loggedInUser.' AND f2.approved = 0) THEN 1 ELSE 0 END AS isUserRequestPending
                ')
            ->get();
    }   

    public static function isFriend($user, $loggedInUser)
    {
        return DB::table('users AS u')
            ->leftJoin('friends AS f', 'u.id', '=', 'f.friend_id')
            ->where('f.friend_id', $user)
            ->orWhere('f.user_id', $user)
            ->selectRaw('
                CASE WHEN (f.id IS NOT NULL AND f.user_id = '.$loggedInUser.' AND f.approved = 1 AND f.approved = 1 OR f.friend_id = '.$loggedInUser.' AND f.approved = 1) THEN 1 ELSE 0 END AS isFollowed,
                CASE WHEN (f.id IS NOT NULL AND f.user_id = '.$loggedInUser.' AND f.approved = 0) THEN 1 ELSE 0 END AS loggedinUserRequestPending,
                CASE WHEN (f.id IS NOT NULL AND f.friend_id = '.$loggedInUser.' AND f.approved = 0) THEN 1 ELSE 0 END AS userRequestPending
                ')
            ->first();
    }

}

