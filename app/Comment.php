<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{

    protected $fillable = [
        'comment', 'post_id', 'user_id',
    ];

	public function post()
	{
		return $this->belongsTo('App\Post');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function notifications()
	{
		return $this->HasOne('App\Notification', 'target', 'post_id');
	}

    public static function get_comment($from, $target, $created_at)
    {
        return DB::table('comments')
            ->join('users', 'comments.user_id', '=', 'users.id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->where('comments.post_id', $target)
            ->where('comments.user_id', $from)
  			->where('comments.created_at', $created_at)
            ->select('posts.images', 'users.id', 'users.firstname', 'users.lastname', 'users.profile_image', 'comments.user_id', 'comments.comment', 'comments.created_at')
            ->first();        
    }	

}
