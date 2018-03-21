<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function queue() {
    	return $this->hasMany('App\FeatureQueue');
    }

    public function venue() {
    	return $this->hasOne('App\Venue');
    }

    public function event() {
        return $this->hasOne('App\Event');
    }

    public function like() {
    	return $this->hasMany('App\FeatureLike');
    }
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($feature) {
            $feature->queue()->delete();
        });

        static::deleting(function($feature) {
            $feature->venue()->delete();
        });

        static::deleting(function($feature) {
            $feature->event()->delete();
        });

        static::deleting(function($feature) {
            $feature->like()->delete();
        });
    }
}
