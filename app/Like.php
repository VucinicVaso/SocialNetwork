<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{

    protected $fillable = [
        'post_id', 'user_id',
    ];

    public function post() { return $this->belongsTo('App\Post'); }

    public function user() { return $this->belongsTo('App\User'); }

}
