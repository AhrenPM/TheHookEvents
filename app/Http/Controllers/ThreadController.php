<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function comments(Request $request) {
    	$thread_id = $request['threadId'];

    	$comments = Thread::find($thread_id)->comments()->latest()->limit(100)->get();
        $userId = Auth::user()->id;

    	return [
    	'comments' => $comments,
    	'userId' => $userId
    	];
    }
}
