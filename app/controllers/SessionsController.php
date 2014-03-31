<?php

class SessionsController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$previousURL = URL::previous();
		Session::put('pre_login_url', $previousURL);

		if(Auth::check()){
			
			return Redirect::to('/');
		}
        	return View::make('user.login');

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//validate
		$url = Session::get('pre_login_url');
		Session::forget('pre_login_url');

		$input = Input::all();

		$attempt = Auth::attempt([
			'email' => $input['email'],
			'password' => $input['password'],
		]);

		if ($attempt) {
			$userid = Auth::user()->id;
			return Redirect::to($url)->with('flash_message', 'Successfully logged in!')
				->with('flash_type', 'alert-success')->with('user_id', $userid);
			}

		return Redirect::back()->with('flash_message', 'Invalid Credentials')->withInput();

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

		return Redirect::to('/')->with('flash_message', 'You have been logged out.');
	}

}
