<?php

class UserController extends BaseController{

	public function register() {

		$data = Input::all();
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
		if(Auth::check()) return View::make('home');
		$data = Input::all();
		$cred = ['email' => $data['login'],
							'password' => $data['password']];
		if(Auth::attempt($cred, true)){
			echo 'ok';
		}
	}

	public function edit_me(){
		header("Expires: Sat, 01 Jan 2005 00:00:00 GMT");
		header("Last-Modified: ".gmdate( "D, d M Y H:i:s")."GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header("Pragma: no-cache");
		$validTypes = array('image/png', 'image/jpg', 'image/jpeg');
		
		$d = Input::file('avatar');

		if($d->isValid()){
			if(array_search($d->getMimeType(), $validTypes)!==false){
				$n = 'img/ex.jpg';
				$img = Image::make($d)->widen(800)->save($n);
				return $n;
				// return $d->move('img/'.substr(md5('temp'),0,10), 'cs'.md5($d->getFileName()).'.'.substr($d->getMimeType(), 6));
			}
		}
	}
}