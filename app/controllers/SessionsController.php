<?php

class SessionsController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
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

		$input = Input::all();

		$attempt = Auth::attempt([
			'email' => $input['email'],
			'password' => $input['password'],
		]);

		if ($attempt) return Redirect::intended('explore')->with('flash_message', 'Successfully logged in!');

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

		return Redirect::home()->with('flash_message', 'You have been logged out.');
	}

}
