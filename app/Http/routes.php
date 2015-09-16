<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Welcome route...
Route::get('/', 'Auth\AuthController@getWelcome');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Facebook route...
Route::post('auth/facebook', 'Auth\AuthController@postFacebook');

// Admin routes...
Route::get('admin/submissions', 'AdminController@getSubmissions');
Route::post('admin/submissions', 'AdminController@postReview');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Submission routes...
Route::resource('submissions', 'SubmissionController');
Route::post('submissions/{id}/vote', [
	'as' => 'submissions.castVote',
	'uses' => 'SubmissionController@castVote'
]);

// Other routes...
Route::get('comments', function() { 
	return view('comments');
});
Route::get('terms', function() { 
	return view('terms');
});
Route::get('test', 'TestController@getTest');



