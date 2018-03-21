<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    public function subject() {
    	return $this->belongsTo('App/Subject');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function concept() {
    	return $this->belongsTo('App\Concept');
    }
}
