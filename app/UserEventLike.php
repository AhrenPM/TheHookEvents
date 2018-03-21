<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserEventLike extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function event() {
    	return $this->belongsTo('App\UserEvent');
    }
}
