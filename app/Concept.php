<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concept extends Model
{
    public function subject() {
    	return $this->belongsTo('App\Subject');
    }

    public function child() {
    	return $this->hasOne('App\Concept', 'parent_id');
    }

    public function parent() {
    	return $this->belongsTo('App\Concept', 'parent_id');
    }

    public function contributions() {
    	return $this->hasMany('App\Contributor');
    }

    public function resources() {
        return $this->hasMany('App\Resource');
    }
}
