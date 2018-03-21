<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function comments() {
    	return $this->hasMany('App\Comment');
    }
}
