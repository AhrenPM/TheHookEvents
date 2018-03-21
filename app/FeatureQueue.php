<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeatureQueue extends Model
{
	public $timestamps = false;

    public function feature() {
    	return $this->belongsTo('App\Feature');
    }

    public function featureGoings() {
    	return $this->hasMany('App\featureGoing');
    }

    // protected static function boot() {
    //     parent::boot();
        
    //     static::deleting(function($featureQueue) {
    //         $featureQueue->featureGoings()->delete();
    //     });
    // }
}
