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

    public static function get_likes($user)
    {
        return DB::table('notifications')
            ->join('users', 'notifications.notification_from', '=', 'users.id')
            ->join('posts', 'notifications.target', '=', 'posts.id')
            ->where('notifications.user_id', $user)
            ->where('notifications.type', 'like')
            ->where('notifications.status', 0)
            ->select('notifications.target', 'posts.images', 'notifications.notification_from', 'users.firstname', 'users.lastname', 'users.profile_image', 'notifications.type', 'notifications.created_at')
            ->orderBy('notifications.id', 'DESC')
            ->get();
    }

    public static function get_comments($user)
    {
        return DB::table('notifications')
            ->join('users', 'notifications.notification_from', '=', 'users.id')
            ->join('posts', 'notifications.target', '=', 'posts.id')
            ->where('notifications.user_id', $user)
            ->where('notifications.type', 'comment')
            ->where('notifications.status', 0)
            ->select('notifications.id AS notifyID', 'notifications.notification_from', 'notifications.created_at', 'posts.images', 'users.firstname', 'users.lastname', 'users.profile_image')
            ->orderBy('notifications.id', 'DESC')
            ->get();
    }
    
}