<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    public $timestamps = false;
    public $guarded = [];

    public function likes() {
    	return $this->hasMany('App\UserEventLike');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
