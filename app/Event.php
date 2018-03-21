<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function feature() {
    	return $this->belongsTo('App\Feature');
    }
}
