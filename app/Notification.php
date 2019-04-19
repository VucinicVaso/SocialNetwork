<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notification extends Model
{

    protected $fillable = [
        'notification_from', 'user_id', 'target', 'type', 'status'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'notification_from', 'id');
    }

    public function post()
    {
    	return $this->belongsTo('App\Post', 'target', 'id');
    }

    public function comment()
    {
       return $this->belongsTo('App\Comment', 'notification_from', 'user_id');
    }    

    public static function get_notifications($user)
    {
        return DB::table('notifications')
        	->join('users', 'notifications.notification_from', '=', 'users.id')
        	->join('posts', 'notifications.target', '=', 'posts.id')
            ->where('notifications.user_id', $user)
            ->where('notifications.status', 0)
            ->select('posts.id', 'posts.images', 'notifications.notification_from', 'users.firstname', 'users.lastname', 'users.profile_image', 'notifications.type', 'notifications.created_at')
            ->orderBy('notifications.id', 'DESC')
            ->get();
    }

}