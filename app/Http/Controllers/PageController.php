<?php

namespace App\Http\Controllers;

use App\Feature;
use App\FeatureQueue;
use App\UserEvent;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function welcome() {
        if(Auth::check()) {
            return redirect('/student-home');
        }

    	return view('parts.welcome');
    }

    public function studentLogin() {
        if(Auth::check()) {
            return redirect('/student-home');
        }
    	return view('parts.studentLogin');
    }

    public function businessLogin() {
        return view('parts.workingOnIt');
    }

    public function visitorHome() {
        $now = Carbon::today('America/Toronto');

        //Var $carousel
        $carouselDate = FeatureQueue::where('event_date', $now->toDateString());
        $carouselPromotion1 = FeatureQueue::where('promotion_1', $now->toDateString());
        $carouselPromotion2 = FeatureQueue::where('promotion_2', $now->toDateString());
        $carouselPromotion3 = FeatureQueue::where('promotion_3', $now->toDateString());
        $carouselForced = FeatureQueue::where('forced', $now->toDateString());

        $carousel = $carouselDate
            ->union($carouselPromotion3)
            ->union($carouselPromotion2)
            ->union($carouselPromotion1)
            ->union($carouselForced)
            ->get();
            
        if(count($carousel) == 0) {
            $carousel = [FeatureQueue::orderBy('event_date', 'asc')->first()];
        }

        //Var $weekOverview
        $weekOverview = FeatureQueue::orderBy('event_date', 'asc')->get();

        //Var $days
        $today = [
            'events' => FeatureQueue::where('event_date', $now->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day2 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day3 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day4 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day5 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day6 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day7= [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $now->subDay(6);

        $days = [];
        array_push($days, $today, $day2, $day3, $day4, $day5, $day6, $day7);


        return view('parts.visitorHome', compact('carousel', 'weekOverview', 'days', 'now'));
    }

    public function studentHome() {
        $now = Carbon::today('America/Toronto');

        //Var $carousel
    	$carouselDate = FeatureQueue::where('event_date', $now->toDateString());
        $carouselPromotion1 = FeatureQueue::where('promotion_1', $now->toDateString());
        $carouselPromotion2 = FeatureQueue::where('promotion_2', $now->toDateString());
        $carouselPromotion3 = FeatureQueue::where('promotion_3', $now->toDateString());
        $carouselForced = FeatureQueue::where('forced', $now->toDateString());

        $carousel = $carouselDate
            ->union($carouselPromotion3)
            ->union($carouselPromotion2)
            ->union($carouselPromotion1)
            ->union($carouselForced)
            ->get();
            
        if(count($carousel) == 0) {
            $carousel = [FeatureQueue::orderBy('event_date', 'asc')->first()];
        }

        //Var $weekOverview
        $weekOverview = FeatureQueue::orderBy('event_date', 'asc')->get();

        //Var $days
        $today = [
            'events' => FeatureQueue::where('event_date', $now->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day2 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day3 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day4 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day5 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day6 = [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $day7= [
            'events' => FeatureQueue::where('event_date', $now->addDay()->toDateString())->get(),
            'userEvents' => UserEvent::where('date', $now->toDateString())->get()
        ];
        $now->subDay(6);

        $days = [];
        array_push($days, $today, $day2, $day3, $day4, $day5, $day6, $day7);


    	return view('parts.studentHome', compact('carousel', 'weekOverview', 'days', 'now'));
    }

    public function checkConfirmation() {
        return view('checkConfirmation');
    }

    public function forgotPassword() {
        return view('forgotPassword');
    }

    public function userAddEvent() {
        return view('parts.userAddEvent');
    }

    public function workingOnIt() {
        return view('parts.workingOnIt');
    }

    public function adminAddEvent() {

        $user = Auth::user();

        $features = Feature::all();
        $queue = FeatureQueue::orderBy('event_date', 'asc')->get();

        if($user->id == 1 && $user->email == "mahlera@mcmaster.ca"){
            return view('parts.adminAddEvent', compact('features', 'queue'));
        } else {
            return redirect('/');
        }
    }

    public function resetPassword($reset_code) {
        return view('resetPassword', compact('reset_code'));
    }

//develop yourself
    public function developYourself() {
        $subjects = Subject::where('is_head', 1)->get();

        return view('parts.developYourself', compact('subjects'));
    }

    public function developSubject($subject, $id) {
        //retrieve the head for the tree
        $head = Subject::find($id);

        if($head->title != $subject) {  //make sure the head matches the id in the url
            return redirect()->back();
        }

        //if the subject is not the a head
        if( !$head->is_head ){
            while( $head->parent_id ) {
                $head = Subject::find( $head->parent_id );
            }
            return redirect('/develop-yourself/'. $head->title .'/'. $head->id );
        }

        //create the array of Topics within the tree
        $subject = $head;
        $topics = [];
        while(!$subject->is_last){
            array_push($topics, $subject);
            $subject = Subject::find($subject->child_id);
            if(is_null($subject)){
                break;
            }
        }
        if(!is_null($subject)) {    //to take care of the last subject
            array_push($topics, $subject);
        }

        $category = $head->category;

        return view('parts.developSubject', compact('head', 'topics', 'category'));
    }

    public function developTopic($topic_title, $id, $num) {

        //retrieve the topic for the page
        $topic = Subject::find($id);

        if($topic->title != $topic_title) {  //make sure the topic_title matches the id in the url
            return redirect()->back();
        }

        $category = $topic->category;

        //get the list of concepts that are related with the current topic
        $concepts = [];

        $currentC = $topic->concepts()->where('parent_id', null)->first();

        for ($i=0; $i<count($topic->concepts()->get()) ; $i++) { 
            array_push($concepts, $currentC);
            if($currentC->child) {
                $currentC =  $currentC->child;
            } else {
                break;
            }
        }

        //get the list of more specific subjects
        $moreSpecific = $topic->children()->get();

        //get the list of similar subjects based on category
        $similarSubjects = Subject::where('category_id', $topic->category_id)->where('is_head', 1)->where('sub_category_id', null)->where('id', '!=', $topic->id)->inRandomOrder()->limit(5)->get();

        //get a random list of unrelated subjects
        $newSubjects = Subject::where('category_id', '!=', $topic->category_id)->where('is_head', 1)->limit(3)->get();



        return view('parts.developTopic',  compact('topic', 'num', 'category', 'concepts', 'moreSpecific', 'similarSubjects', 'newSubjects'));
    }
}
