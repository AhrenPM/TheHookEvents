<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Event;
use App\Venue;
use App\FeatureLike;
use App\FeatureGoing;
use App\FeatureQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
use Image;
use Validator;

class FeatureController extends Controller
{
    public function like(Request $request) {
    	$featureId = $request['featureId'];
        $feature = Feature::find($featureId);

        if($feature == null) {
            return;
        }

        $user = Auth::user();
        $like = $user->featureLikes->where('feature_id', $featureId)->first();

        if($like){       // the entry exists already for the user
            $like->delete();
            $feature->likes = $feature->likes-1;
            $feature->update();
            return [$feature->likes, "Like"];
        } else {    // if the entry does not exist
            $like = new FeatureLike();
        }

        $like->user_id = $user->id;
        $like->feature_id = $featureId;
        $like->liked = true;
        $like->save();

        $feature->likes = $feature->likes +1;
        $feature->update();

        return [$feature->likes, "Liked"];
    }

    public function going(Request $request) {
    	$queueId = $request['queueId'];
    	$queue = FeatureQueue::find($queueId);

    	if($queue == null) {
    		return;
    	}

    	$user = Auth::user();
    	$going = $user->featureGoings->where('queue_id', $queueId)->first();
    	if($going) {
    		$going->delete();
    		if($queue->going > 0) {
    			$queue->going = $queue->going -1;
    		}
    		$queue->update();
    		return [$queue->going, "Going"];
    	} else {
    		$going = new FeatureGoing();
    	}

    	$going->queue_id = $queue->id;
    	$going->user_id = $user->id;
    	$going->going = 1;
    	$going->save();

		$queue->going = $queue->going +1;
		$queue->update();

		return [$queue->going, "Going!"];
    }

    public function create() {

        if(Input::get('theme') == 1) {
            $input = Input::only(
                'name',
                'description',
                'image',
                'theme',
                'location',
                'website',
                'start_time',
                'end_time',
                'tickets',
                'recurring_weekly',
                'recurring_end'
                );

            $rules = [
                'name' => 'required|max:30;',
                'description' => 'required|max:650',
                'image' => 'required|image|file',
                'theme' => 'required',
                'location' => 'required|max:50',
                'website' => 'nullable',
                'start_time' => 'required|date',
                'end_time' => 'nullable|date',
                'tickets' => 'nullable',
                'recurring_weekly' => 'nullable',
                'recurring_end' => 'nullable|date'
                ];

            $validator = Validator::make($input, $rules);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $featureIMG = Input::file('image');
            $filename = time();

            $now = Carbon::now("America/Toronto");
            $date = $now->year . '-' . $now->weekOfYear;

            if(!is_dir(public_path('/img/feat/' . $date))) {
                mkdir(public_path('/img/feat/' . $date));
            }

            $image = Image::make($featureIMG)->widen(1000);
            
            if($image->filesize() > 5000000){
                $errors = new MessageBag(['image', ['The image size is too large, please compress the image then try again']]);

                return redirect()->back()->withErrors($errors)->withInput();
            } 

            $image->save(public_path('/img/feat/'. $date . '/' . $filename . '.jpg'));

            $feature = new Feature();
            $feature->theme_id = Input::get('theme');
            $feature->name = Input::get('name');
            $feature->description = Input::get('description');
            $feature->image = '/img/feat/'. $date . '/' . $filename . '.jpg';
            $feature->belongs_to_user = true;
            $feature->added_id = Auth::user()->id;
            $feature->save();

            $event = new Event();
            $event->feature_id = $feature->id;
            $event->location = Input::get('location');
            $event->start_time = Input::get('start_time');
            $event->end_time = Input::get('end_time');
            $event->website = Input::get('website');
            $event->tickets = (Input::get('tickets') ? true : false);
            $event->recurring_weekly = (Input::get('recurring_weekly') ? true : false);
            $event->recurring_end = Input::get('recurring_end');
            $event->save();

            $queue = new FeatureQueue();
            $queue->feature_id = $feature->id;
            $queue->promotion_1 = null;
            $queue->promotion_2 = null;
            $queue->promotion_3 = null;
            $queue->forced = null;
            $queue->event_date = Carbon::parse($event->start_time)->toDateString();
            $queue->save();

            $feature->uses = $feature->uses +1;
            $feature->update();

        } elseif (Input::get('theme') == 2) {
            $input = Input::only(
                'name',
                'description',
                'image',
                'theme',
                'location',
                'website',
                'opens',
                'reserve'
                );

            $rules = [
                'name' => 'required|max:30;',
                'description' => 'required|max:650',
                'image' => 'required|image|file',
                'theme' => 'required',
                'location' => 'required|max:50',
                'website' => 'nullable',
                'opens' => 'required',
                'reserve' => 'nullable'
                ];

            $validator = Validator::make($input, $rules);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $featureIMG = Input::file('image');
            $filename = time();

            $now = Carbon::now("America/Toronto");
            $date = $now->year . '-' . $now->weekOfYear;

            if(!is_dir(public_path('/img/feat/' . $date))) {
                mkdir(public_path('/img/feat/' . $date));
            }

            $image = Image::make($featureIMG)->widen(1000);
            
            if($image->filesize() > 5000000){
                $errors = new MessageBag(['image', ['The image size is too large, please compress the image then try again']]);

                return redirect()->back()->withErrors($errors)->withInput();
            }

            $image->save(public_path('/img/feat/'. $date . '/' . $filename . '.jpg'));

            $feature = new Feature();
            $feature->theme_id = Input::get('theme');
            $feature->name = Input::get('name');
            $feature->description = Input::get('description');
            $feature->image = '/img/feat/'. $date . '/' . $filename . 'jpg';
            $feature->belongs_to_user = true;
            $feature->added_id = Auth::user()->id;
            $feature->save();

            $venue = new Venue();
            $venue->feature_id = $feature->id;
            $venue->location = Input::get('location');
            $venue->opens_at = Input::get('opens');
            $venue->website = Input::get('website');
            $venue->reserve = (Input::get('reserve') ? true : false);
            $venue->save();

        } else {
            $errors = new MessageBag(['no-theme' => 'You did not choose a theme']);
            return redirect()->back()->withErrors($errors)->withInput();
        }

        return redirect()->back();
    }

    public function delete(Request $request) {
        $featureId = $request['featureId'];
        $feature = Feature::find($featureId);

        if($feature == null) {
            return;
        }

        $feature->delete();
        return;
    }
}
