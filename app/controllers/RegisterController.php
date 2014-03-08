<?php

class RegisterController extends BaseController {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check()){
			return Redirect::to('explore');
		}else
        	return View::make('user.register');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	
		$input = Input::all();

		$rules = array(
			'email' => array('required', 'email', 'unique:users,email'),
			'password' => array('required', 'min:6'),
			'username' => array('required', 'min:3', 'unique:users,username')
		);
		
		$messages = array(
			'email.email' => 'Please enter a valid E-mail address.',
			'email.required' => 'E-mail is required.',
			'password.required' => 'Password is required.',
			'username.required' => 'Username is required.',
			'password.min' => 'Password is too short! Min 5 symbols.',
			'username.min' => 'Username is too short! Min 4 symbols.',
			'email.unique' => 'This e-mail has already been taken.',
			'username.unique' => 'This username has already been taken.',
		);
		
		$validation = Validator::make($input, $rules, $messages);
		
		if ($validation->fails()) {
			return Redirect::to('register')->withInput()->withErrors($validation);		
		}
		else{
			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->username = Input::get('username');
			$user->save();

			$attempt = Auth::attempt([
				'email' => $input['email'],
				'password' => $input['password'],
			]);
			
			if ($attempt) return Redirect::intended('explore')->with('flash_message', 'Thank you for registering!');
		}
	}

}
