<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subjects() {
    	return $this->hasMany('App\Subject');
    }

    public function sub() {
    	return $this->hasMany('App\Category', 'super_id');
    }

    public function super() {
    	return $this->belongsTo('App\Category', 'super_id');
    }
}
