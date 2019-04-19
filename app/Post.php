<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    protected $fillable = [
        'body', 'images', 'user_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification', 'target', 'id');
    }

    public static function postComments($id)
    {
        return DB::table('posts')
            ->join('comments', 'posts.id', '=', 'comments.post_id')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->where('posts.id', $id)
            ->get();
    }

}
