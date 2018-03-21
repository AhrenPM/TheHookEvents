<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\resetPassword;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function resetPassword() {
    	$user = Auth::user();

    	$data = $user->confirmation_code;

        Mail::to( $user->email )->send(new resetPassword($data));


        return redirect("/student-home");
    }
}
