<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\accountConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Validator;

class RegisterController extends Controller
{
	//Register a new user
    public function studentRegister(Request $request) {

    	//retrieve the required fields and set the rules
		$input = Input::only(
			'Firstname',
			'Lastname',
			'Username',
			'SignUpEmail',
			'SignUpPassword',
			'SignUpPassword_confirmation'
			);
		$rules = [
			'Firstname' => 'required|alpha|max:20',
			'Lastname' => 'required|alpha|max:20',
			'Username' => 'min:5|max:15',
			'SignUpEmail' => 'required|unique:users,email|email',
			'SignUpPassword' => 'required|min:5|max:20|confirmed'
		];

		//Make the validation and check
		$validator = Validator::make($input, $rules);
		if($validator->fails())
        {
        	Input::flash();
            return redirect()->back()->withInput(Input::except('SignUpPassword'))->withErrors($validator);
        } 
        else if(strpos(Input::get('SignUpEmail'),'@mcmaster.ca') == false)
        {
        	return redirect()->back()->withInput(Input::except('SignUpPassword'))->withErrors(['Please enter your student email']);
        }

        //create the confirmation code
		$confirmation_code = str_random(30);

		//Make the user
		$user = User::create([
			'firstname' => Input::get('Firstname'),
			'lastname' => Input::get('Lastname'),
			'username' => Input::get('Username'),
			'email' => Input::get('SignUpEmail'),
			'password' => bcrypt(Input::get('SignUpPassword')),
			'confirmation_code' => $confirmation_code
			]);

		//send the confirmation email
		$data = $user->confirmation_code;

		Mail::to( $user->email )->send(new accountConfirm($data));

		return view('checkConfirmation');

    }

    public function userConfirm($confirmation_code) {

    	$user = User::where('confirmation_code', $confirmation_code)->first();
    	
    	if(!is_null($user)) {
    		$user->confirmation_code = '';
    		$user->confirmed = 1;
    		$user->save();
    		$name = $user->firstname;
    		$confirmed = true;

			Auth::login($user, true);
    	} else {
    		$confirmed = false;
    		$name = null;
    	}

    	return view('accountConfirmed', compact('name', 'confirmed'));
    }

    public function resendConfirmation(Request $request) {
    	$email = $request['email'];
    	$user = User::where('email', $email)->first();

    	if(!is_null($user)) {
    		if($user->confirmed == 1) {
    			$errors = new MessageBag(['confirmed' => ['That account has already been confirmed']]);
				
				return redirect()->back()->withErrors($errors);
    		}
    		//create the new confirmation code
			$confirmation_code = str_random(30);

			$user->confirmation_code = $confirmation_code;
			$user->save();
			Mail::to( $email )->send(new accountConfirm($confirmation_code));

			return redirect()->back()->with('resent', 'Your email has been re-sent');
    	}

    	$errors = new MessageBag(['email' => ['That email is invalid']]);

		return redirect()->back()->withErrors($errors);
    }
}
