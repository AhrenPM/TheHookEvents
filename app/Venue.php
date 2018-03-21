<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
	public $timestamps = false;
	
    public function feature() {
    	return $this->belongsTo('App\Feature');
    }
}
