<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Page Routes

Route::get('/', [
	'uses' => 'PageController@studentLogin'
	]);
Route::get('/student-login',[
	'uses' => 'PageController@studentLogin'
	]);
Route::get('/student-home',[
	'uses' => 'PageController@studentHome'
	])->middleware('auth');
Route::get('/add-event', [
	'uses' => 'PageController@userAddEvent'
	])->middleware('auth');
Route::get('/develop-yourself', [
	'uses' => 'PageController@developYourself'
	]);

Route::get('/business-login', [
	'uses' => 'PageController@businessLogin'
	]);

Route::get('/visitor-home', [
	'uses' => 'PageController@visitorHome'
	]);

Route::get('/working-on-it', [
	'uses' => 'PageController@workingOnIt'
	]);

Route::get('/check-confirmation', [
	'uses' => 'PageController@checkConfirmation'
	]);

Route::get('/user/forgot-password', [
	'uses' => 'PageController@forgotPassword'
	]);

Route::get('/user/reset-password/{reset_code}', [
	'uses' => 'PageController@resetPassword'
	]);

//Student User Routes

Route::post('/user/login', [
	'uses' => 'LoginController@studentLogin'
	]);

Route::post('/user/create', [
	'uses' => 'RegisterController@studentRegister'
	]);

Route::get('/user/log-out', [
	'uses' => 'LogoutController@studentLogout'
	]);

Route::post('/user/send-password-reset', [
	'uses' => 'LoginController@sendPasswordReset',
	'as' => 'sendPasswordReset'
	]);

//Liking and Going

Route::post('/feature/like', [
	'uses' => 'FeatureController@like',
	'as' => 'LikeFeature'
	]);

Route::post('/feature/going', [
	'uses' => 'FeatureController@going',
	'as' => 'GoingFeature'
	]);


//User Events

Route::post('/userevents/create', [
	'uses' => 'UserEventController@create',
	'as' => 'CreateUserEvent'
	]);

Route::post('/userevents/like', [
	'uses' => 'UserEventController@like',
	'as' => 'LikeUserEvent'
	]);


//Admin Stuffs

Route::get('/007admin-addE', [
	'uses' => 'PageController@adminAddEvent'
	])->middleware('auth');

//Feature Stuff

Route::post('/feature/create', [
	'uses' => 'FeatureController@create'
	])->middleware('auth');

Route::delete('/feature/delete', [
	'uses' => 'FeatureController@delete',
	'as' => 'deleteFeature'
	])->middleware('auth');

//FeatureQueue

Route::post('/feature-queue/create', [
	'uses' => 'FeatureQueueController@create',
	'as' => 'addToQueue'
	])->middleware('auth');

Route::post('/feature-queue/promote', [
	'uses' => 'FeatureQueueController@promote',
	'as' => 'promoteFeature'
	])->middleware('auth');

Route::post('/feature-queue/force', [
	'uses' => 'FeatureQueueController@force',
	'as' => 'forceFeature'
	])->middleware('auth');

Route::delete('/feature-queue/delete', [
	'uses' => 'FeatureQueueController@delete',
	'as' => 'deleteQueue'
	])->middleware('auth');


//emails
Route::post('/user/reset-password', [
	'uses' => 'LoginController@resetPassword',
	'as' => 'resetPassword'
	]);

Route::get('/user/confirmation/{confirmation_code}', [
	'uses' => 'RegisterController@userConfirm',
	'as' => 'confirmAccount'
	]);

Route::post('/user/re-confirm', [
	'uses' => 'RegisterController@resendConfirmation',
	'as' => 're-confirm'
	]);


//Learning routes
Route::get('/develop-yourself/{subject}/{id}', [
	'uses' => 'PageController@developSubject'
	])->middleware('auth');

Route::get('/develop-yourself/topic/{topic_title}/{id}:{num}', [
	'uses' => 'PageController@developTopic'
	])->middleware('auth');

Route::post('/develop-yourself/topic/comments', [
	'uses' => 'ThreadController@comments',
	'as' => 'GetComments'
	])->middleware('auth');

Route::post('subject/{conceptId}/resource/create', [
	'uses' => 'ConceptController@create',
	'as' => 'createResource'
	])->middleware('auth');