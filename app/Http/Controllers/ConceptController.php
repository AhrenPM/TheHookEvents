<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use JonnyW\PhantomJs\Client;
use Carbon\Carbon;
use Image;
use Validator;

class ConceptController extends Controller
{
    public function create($conceptId, Request $request) {
    	// validate
        $input = Input::only(
            'url',
            'file',
            'resourceImage',
            'useDefaultImage'
            );

        $rules = [
            'file' => 'required_if:url,null',
            'url' => 'required_if:file,null|URL|nullable',
            'resourceImage' => 'required_if:useDefaultImage,null',
            'useDefaultImage' => 'required|nullable'
            ];

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // if user provided an image
      	if(!$request['useDefaultImage']) {
            $resourceIMG = Input::file('resourceImage');
            $filename = time();

            $now = Carbon::now("America/Toronto");
            $date = $now->year . '-' . $now->weekOfYear;

            if(!is_dir(public_path('/img/resources/' . $date))) {
                mkdir(public_path('/img/resources/' . $date));
            }

    		$image = Image::make($resourceIMG)->widen(300);
        
            if($image->filesize() > 5000000){
                $errors = new MessageBag(['image', ['The image size is too large, please compress the image then try again']]);

                return redirect()->back()->withErrors($errors)->withInput();
            }

    	    $image->save(public_path('/img/resources/'. $date . '/' . $filename . '.jpg'));

        } elseif(($request['useDefaultImage'] == 'on') && ($request['url'] != null)) {	//if the user did not provide an image and the url is present

        	$filename = time();

            $now = Carbon::now("America/Toronto");
            $date = $now->year . '-' . $now->weekOfYear;

            if(!is_dir(public_path('/img/resources/' . $date))) {
                mkdir(public_path('/img/resources/' . $date));
            }

        	$url = $request['url'];

		    $width  = 1330;
		    $height = 750;

        	$client = Client::getInstance();
        	$client->getEngine()->setPath('..\bin\phantomjs.exe');

		    $request  = $client->getMessageFactory()->createCaptureRequest($url);
		    $request->setViewportSize($width, $height);
		    $response = $client->getMessageFactory()->createResponse();
		    
		    $file = '../bin/' . $filename . '.jpg';
		    
		    $top    = 10;
		    $left   = 10;
		    $width  = 1330;
		    $height = 750;
		    
		    $request->setCaptureDimensions($width, $height, $top, $left);
		    $request->setOutputFile($file);
		    $client->send($request, $response);

		    rename('../bin/' . $filename . '.jpg', '../public/img/resources/'. $date . '/' . $filename . '.jpg');

		    $image = Image::make('../public/img/resources/'. $date . '/' . $filename . '.jpg')->widen(300);
		    $image->crop(300,170,0,0);

    	    $image->save(public_path('/img/resources/'. $date . '/' . $filename . '.jpg'));


        } else {	//use the document placeholder image
        	// return redirect()->back();
        }

        // return redirect()->back();
    }
}
