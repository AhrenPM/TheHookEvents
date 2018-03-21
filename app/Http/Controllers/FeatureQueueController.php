<?php

namespace App\Http\Controllers;

use App\FeatureQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FeatureQueueController extends Controller
{
    public function create(Request $request) {
    	$date = $request['date'];
    	$id = $request['featureId'];

    	if($date == '') {
    		return "Please choose a date";
    	}
    	
    	$queue = new FeatureQueue();
    	$queue->feature_id = $id;
    	$queue->promotion_1 = null;
    	$queue->promotion_2 = null;
    	$queue->promotion_3 = null;
    	$queue->forced = null;
    	$queue->event_date = $date;
    	$queue->save();

    	$queue->feature->uses = $queue->feature->uses +1;

    	return;
    }

    public function promote(Request $request) {
    	$date = $request['date'];
    	$id = $request['featureId'];
    	$column = $request['promoteNum'];

    	$queue = FeatureQueue::find($id);
    	if( $queue == null || $queue->feature == null) {
    		return "That queue or feature does not exist";
    	}

    	if($column == 1) {
    		$queue->promotion_1 = $date;
    	} elseif($column == 2) {
    		$queue->promotion_2 = $date;
    	} elseif($column == 3) {
    		$queue->promotion_3 = $date;
    	} else {
    		return "The promotion number does not exist";
    	}
    	$queue->update();

    	return;
    }

    public function force(Request $request) {
    	$id = $request['featureId'];

    	$queue = FeatureQueue::find($id);
    	if( $queue == null || $queue->feature == null) {
    		return "That queue or feature does not exist";
    	}

    	if( $queue->forced == null ) {
    		$queue->forced = Carbon::now("America/Toronto")->toDateString();
    	} else {
    		$queue->forced = null;
    	}
    	$queue->update();

    	return;
    }

    public function delete(Request $request) {
    	$id = $request['QueueId'];
    	$queue = FeatureQueue::find($id);

    	if($queue){
    		$queue->delete();
    	}

    	return;
    }
}
