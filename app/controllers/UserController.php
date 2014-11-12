<?php

class UserController extends BaseController{

	public function register() {

		$data = Input::all();
		var_dump($data);
		$rules = [
				'email' => 'required|unique:users',
				'password' => 'required|min:8',
				'repeat_password' => 'same:password'
		];

		$val = Validator::make($data, $rules);

		if($val->fails())
			return $val ->messages();
		else {
			$user = User::create([
								'email' => $data['email'],
								'password' => Hash::make($data['password'])
								]);
			// credentials
			$cred = [
					'email' => $data['email'],
					'password' => $data['password']
				];
			Auth::attempt($cred);

			return Redirect::to('id' . Auth::id());
		}
	}


	public function ajax_check_email(){

		$data = Input::get('data');

		$data = json_decode($data);

		$d = [ 'email' => $data ];

		$rules = [ 'email' => 'required|email|unique:users' ];

		$valid = Validator::make($d, $rules);

		if($valid->fails()){
			return Response::json(['type' => 'fail', 'msg' => $valid->messages()]);
		} else {
			return Response::json(['type' => 'good']);
		}
	}


	public function profile($id){
		if(Auth::check())
			return View::make('profile');
		else if(Auth::guest())
			return 'View::make()';
	}

	public function login(){
		$data = Input::all();
		$cred = ['email' => $data['login'],
							'password' => $data['password']];
		if(Auth::attempt($cred, true)){
			echo 'ok';
		}
	}

	public function edit_me(){
		
	}
}