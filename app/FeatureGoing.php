<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureGoing extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function queue() {
    	return $this->belongsTo('App\FeatureQueue');
    }
}
