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
Route::resource('search', 'SearchController', ['only' => ['store']]);

//Movie Routes
Route::get('movie/{id}/', ['as' => 'movie', function($id)
{	
	$tmdbid = $id;
	$favorites_auth = array();
	
	if(Auth::check()) //get the authenticated users info to compare
	{ 
		$auth_userid = Auth::user()->id;
		$favorites_auth = DB::table('favorites')->where('user_id', '=',  $auth_userid)->lists('movie_id'); //gets users favorite movies as array
		$is_logged_in = 'yes';
	}else{
		$is_logged_in = 'no';
	}

	return View::make('movie', compact('tmdbid', 'favorites_auth','is_logged_in'));
}]);

Route::get('movie/{id}/related', function($id)
{
	return View::make('related', compact('id'));
});


//visiting someone's favorites by username
Route::get('users/{username}/favorites', ['as' => 'user.favorites', function ($username)
{
	try{
		$userid = DB::table('users')->where('username', '=', $username)->first()->id; //get the visited username's id
	}catch(Exception $exception){
		return View::make('404error');
	}
	$user_name = $username;
	$auth_username = '';
	$favorites_auth = array();
	if(Auth::check()) //get the authenticated users info to compare
	{ 
		$auth_userid = Auth::user()->id;
		$auth_username = Auth::user()->username;
		$favorites_auth = DB::table('favorites')->where('user_id', '=',  $auth_userid)->lists('movie_id');
		$is_logged_in = 'yes';
	}else{
		$is_logged_in = 'no';
	}

	$favorited_movies = Favorite::where('user_id', '=', $userid)->get(); //gets favorited movies of visited user
	$last_updated = DB::table('favorites')->where('user_id', '=', $userid) //query db to get last updated date
								->orderBy('updated_at', 'desc')
								->first();
	
	$last_updated_date = substr($last_updated->updated_at, 0, 10);
	//dd($last_updated_date);
	$moviesArr = array();
	foreach($favorited_movies as $movie){
		$movieID = $movie->movie_id;
		$newmovie = Movie::where('tmdb_id', '=', $movieID)->first();
		array_push($moviesArr, $newmovie);
	}

	$baseURL = 'http://image.tmdb.org/t/p/w185';

    return View::make('user.favorites', compact('baseURL', 'favorites_auth', 'auth_username', 'user_name', 'moviesArr', 'is_logged_in', 'last_updated_date'));
}]);

//route for posting to favorites
Route::post('favorites', ['as' => 'favorites.store', function()
{
    //see if that movie-id exists in our local database, if not create it
    if($title = Input::get('movie-title')){
    	 $movie = Movie::firstOrCreate(array(
    	'title' => $title,
    	'tmdb_id' => Input::get('movie-id'),
    	'rottentomatoes_id' => Input::get('rotten-id'),
    	'imdb_id' => Input::get('imdb-id'),
    	'year'	=> Input::get('year'),
    	'release_date' => Input::get('release-date'),
    	'genre' => Input::get('genre'),
    	'poster_path' => Input::get('poster-path'),
    	'critics_rating' => Input::get('critics-rating'),
    	'audience_rating' => Input::get('audience-rating'),
    	'runtime' => Input::get('runtime')
    		));
    }


    $movie_id = Input::get('movie-id');

    Auth::user()->favorites()->attach($movie_id);

    return Redirect::back();
}])->before('auth|csrf');

//delete a favorite
Route::delete('favorites/{movieId}', ['as' => 'favorites.destroy', function()
{
    $movie_id = Input::get('movie-id');

    Auth::user()->favorites()->detach($movie_id);

    return Redirect::back();
}])->before('auth|csrf');



