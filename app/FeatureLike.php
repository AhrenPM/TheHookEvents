<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureLike extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function feature() {
    	return $this->belongsTo('App\Feature');
    }
}
