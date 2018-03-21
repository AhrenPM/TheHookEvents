<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function concepts() {
    	return $this->hasMany('App\Concept');
    }

    public function parents() {
        return $this->hasMany('App\RelatedSubjects', 'child_id');
    }

    public function children() {
    	return $this->hasMany('App\RelatedSubjects', 'parent_id');
    }

    public function contributions() {
    	return $this->hasMany('App\Contributor');
    }

    public function threads() {
        return $this->hasMany('App\Thread');
    }

    public function directChild() {
        return $this->hasOne('App\Subject', 'parent_id');
    }

    public function directParent() {
        return $this->belongsTo('App\Subject', 'child_id');
    }
}
