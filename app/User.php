<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    
	protected $fillable = ['firstname', 'lastname', 'username', 'email', 'password', 'confirmation_code'];
    protected $hidden = ['password'];

    public function features() {
    	return $this->hasMany('App\Feature');
    }

    public function featureLikes() {
    	return $this->hasMany('App\FeatureLike');
    }

    public function featureGoings() {
    	return $this->hasMany('App\FeatureGoing');
    }

    public function userEvents() {
        return $this->hasMany('App\UserEvent');
    }

    public function userEventLikes() {
        return $this->hasMany('App\UserEventLike');
    }

    public function passwordReset() { 
        return $this->hasOne('App\PasswordReset');
    }

    public function contributions() {
        return $this->hasMany('App\Contributor');
    }

    public function threads() {
        return $this->hasMany('App\Thread');
    }
}
