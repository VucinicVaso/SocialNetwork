<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Friend extends Model
{

    protected $fillable = [
        'friend_id', 'user_id', 'approved'
    ];

    public function user() { return $this->belongsTo('App\User'); }

    public static function friendsRequests()
    {           
        return DB::table('friends')
            ->join('users', 'friends.user_id', '=', 'users.id')
            ->where('friends.friend_id', auth()->user()->id)
            ->where('friends.approved', '=', 0)
            ->get();
    }

    public static function friendsList($id)
    {
        return DB::table('friends')
            ->join('users', 'friends.friend_id', '=', 'users.id')
            ->where('friends.user_id', $id)
            ->where('friends.approved', '!=', 0)
            ->select('friends.friend_id', 'users.firstname', 'users.lastname', 'users.profile_image')
            ->get();
    }

}
