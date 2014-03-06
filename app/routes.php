<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', function()
{
	if(Auth::check()){
		return View::make('explore');
	}else
		return View::make('home');
}));

Route::get('home', function(){
	return View::make('home');
});

Route::get('explore', array('as' => 'explore', function()
{
	return View::make('explore');
}));

Route::get('login', array('as' => 'signin', 'uses' => 'SessionsController@create'));

Route::get('profile', function()
{
	return View::make('user.profile');
})->before('auth');

Route::get('lists', function()
{
	return View::make('user.lists');
})->before('auth');

Route::controller('password', 'RemindersController');

Route::get('register',  array('as' => 'registration', 'uses' => 'RegisterController@create'));
Route::get('logout', 'SessionsController@destroy');

Route::resource('registration', 'RegisterController', ['only' => ['index', 'create', 'store']]);
Route::resource('sessions', 'SessionsController', ['only' => ['index', 'create', 'destroy', 'store']]);
Route::resource('settings', 'SettingsController', ['only' => ['index', 'create', 'store']]);
Route::resource('search', 'SearchController', ['only' => ['store']]);

Route::get('movie/{id}/', function($id)
{	
	if(Auth::check()){
		$loggedin = 'yes';
	}
	else
		$loggedin = 'no'; 

	return View::make('movie', compact('id', 'loggedin'));
});

Route::get('movie/{id}/related', function($id)
{
	return View::make('related', compact('id'));
});

Route::resource('favorites', 'FavoritesController', ['only' => ['index', 'store', 'destroy']]);
