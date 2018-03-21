<?php

namespace App\Http\Controllers;

use App\User;
use App\PasswordReset;
use App\Mail\resetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Validator;

class LoginController extends Controller
{
	//Login a user
    public function studentLogin(Request $request) {

    	//if a user is already logged in, log them out
		$user = Auth::user();
		Auth::logout($user);

		//attempt to log in the new user
		if(Auth::attempt(['email' => $request['LoginEmail'], 'password' => $request['LoginPassword'], 'confirmed' => 1])){
			//check to see if they want a remember cookie
			$remember = $request['remember'];
			if(!empty($remember)) {
				Auth::login(Auth::user(), true);
			}

			return redirect('/student-home');
		} else {
			//if the user has not confirmed their account yet
			$user = User::where('email', $request['LoginEmail'])->first();
			if($user->confirmed == 0) {
				return redirect('/check-confirmation');
			}
		}

		//return that something was input incorrectly
		$errors = new MessageBag(['password' => ['Email and/or password invalid.']]);

		return redirect()->back()->withErrors($errors)->withInput();
    }

    //logout a user
    public function studentLogout() {
		Auth::logout();

		return redirect('/');
	}

	public function sendPasswordReset(Request $request) {
		$email = $request['email'];
    	$user = User::where('email', $email)->first();

    	if(!is_null($user)) {
    		$reset_code = str_random(40);

    		if(is_null($user->passwordReset)){
	    		$passwordReset = new PasswordReset;
	    		$passwordReset->user_id = $user->id;
	    		$passwordReset->reset_code = $reset_code;
	    		$passwordReset->save();
	    	} else {
	    		$user->passwordReset->reset_code = $reset_code;
	    		$user->passwordReset->save();
	    	}

    		Mail::to( $email )->send(new resetPassword($reset_code));

    		if(Mail::failures()) {
    			$errors = new MessageBag(['email' => ['There was an error sending the email']]);
    			return redirect()->back()->withErrors($errors);
    		}

			return redirect()->back()->with('sent', 'Your reset email has been sent');
    	}

    	$errors = new MessageBag(['email' => ['That email is invalid']]);
		return redirect()->back()->withErrors($errors);
	}

	public function resetPassword(Request $request) {
		$input = Input::only(
			'ResetPassword',
			'ResetPassword_confirmation'
			);
		$rules = [
		'ResetPassword' => 'required|min:5|max:20|confirmed',
		];

		//Make the validation and check
		$validator = Validator::make($input, $rules);
		if($validator->fails())
        {
        	Input::flash();
            return redirect()->back()->withErrors($validator);
        } 

        $reset = PasswordReset::where('reset_code', $request['reset_code'])->first();
        if(!is_null($reset)) {
        	$user = $reset->user()->first();
        } else {
        	$errors = new MessageBag(['reset_code' => ['Please re-send your forgotten password email']]);
       		return redirect()->back()->withErrors($errors);
        }
       	
       	if(!is_null($user)){
       		$user->password = bcrypt($request['ResetPassword']);
       		$user->save();

       		$user->passwordReset()->first()->delete();
       	} else {
       		$errors = new MessageBag(['user' => ['No such user reset exists']]);
       		return redirect()->back()->withErrors($errors);
       	}


		return redirect('/student-login');
	}
}
