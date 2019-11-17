<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $fillable = [
        'title', 'user_id'
    ];

    public function user() { return $this->belongsTo('App\User'); }

    public function photos() { return $this->hasMany('App\Photo'); }

}
