<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{

    protected $fillable = [
        'body', 'images', 'user_id',
    ];

    public function user() { return $this->belongsTo('App\User')->select('id', 'firstname', 'lastname', 'profile_image'); }

    public function comments() { return $this->hasMany('App\Comment')->select('id', 'post_id', 'user_id', 'comment', 'created_at'); }

    public function commentsWithUserData() { return $this->comments()->with('user'); }

    public function likes() { return $this->hasMany('App\Like'); }

    public function isLiked() { return $this->likes()->where('user_id','=', auth()->user()->id); }

    public function notifications() { return $this->hasMany('App\Notification', 'target', 'id'); }

}
