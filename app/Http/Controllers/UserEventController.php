<?php

namespace App\Http\Controllers;

use App\UserEvent;
use App\UserEventLike;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class UserEventController extends Controller
{
    public function create(Request $request) {
    	$name = $request['name'];
    	$date = $request['date'];

        //make a carbon copy of the date by cycling through each day of the week
    	$testDay = Carbon::today("America/Toronto");
    	for($i=0; $i<7; $i++ ){
	    	if($testDay->dayOfWeek != $date){
	    		$testDay->addDay();
	    	}else{
	    		break;
	    	}
	    }
	    
        //retrieve all the events with the same name and title as the event submitted
        $retrieved = UserEvent::where('name', '=', $name)->where('date', '=', $testDay->toDateString())->first();

        //if retrieved is empty then the count variable gets set to 0
        if($retrieved == null){
            $count = 0;
            $new = true;
        }else{
            //other wise set the count variable to the current value
            //there should only be one of each event so we update the first element in the list
            $count = $retrieved->likes;
            $count++;
            $new = false;
        }

        $user = Auth::user();
        //update or create the current event with the correct title and date
        //increase the count varibale by one

	    $event = UserEvent::updateOrCreate(
            ['date' => $testDay->toDateString(), 'name' => $name], 
            ['likes' => $count, 'user_id' =>  $user->id]);

    	return [
        "likes" => $count, 
        "day" => $testDay->format('l'),
        "isNew" => $new, 
        "id" => $event->id
        ];
    }

    public function like(Request $request) {
    	$eventId = $request["eventId"];
    	$event = UserEvent::find($eventId);

    	if( $event == null) {
    		return;
    	}
        
    	$user = Auth::user();
    	$like = $user->userEventLikes->where("event_id" , $eventId)->first();
        
        if($like) {
            $like->delete();
            if($event->likes > 0){
                $event->likes = $event->likes -1;
            }
            $event->update();
            return [
        "likes" => $event->likes,
        "color" => "#333333"
        ];
        } else {
            $like = new UserEventLike();
        }

        $like->user_id = $user->id;
        $like->event_id = $eventId;
        $like->save();

        $event->likes = $event->likes +1;
        $event->update();

        return [
        "likes" => $event->likes,
        "color" => "#ff7900"
        ];
    }
}
