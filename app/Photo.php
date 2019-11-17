<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = [
        'user_id', 'gallery_id', 'photo'
    ];

    public function user() { return $this->belongsTo('App\User'); }

    public function gallery() { return $this->belongsTo('App\Gallery'); }

}
