<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RelatedSubjects extends Model
{
    public function parent() {
    	return $this->belongsTo('App\Subject', 'parent_id');
    }

    public function child() {
    	return $this->belongsTo('App\Subject', 'child_id');
    }
}
