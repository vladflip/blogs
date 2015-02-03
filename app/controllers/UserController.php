<?php

class UserController extends BaseController{

	public function register() {

		$data = Input::all();
		$rules = [
				'email' => 'required|unique:users',
				'password' => 'required|min:5',
				'repeat_password' => 'same:password'
		];

		$val = Validator::make($data, $rules);

		if($val->fails())
			return $val->messages();
		else {
			$confirmation_code = md5(str_random(30));

			$user = User::create([
								'email' => $data['email'],
								'password' => Hash::make($data['password']),
								'confirmation_code' => $confirmation_code
							]);
			Auth::attempt([
						'email' => $data['email'],
						'password' => $data['password']
					], true);

			$user->verify();

			return Redirect::to('id'.$user->id);		
		}
	}

	public function verify($code){
		if( ! $code){
			throw new InvalidConfirmationCodeException;
		}

		$user = User::whereConfirmationCode($code)->first();

		if( ! $user){
			throw new InvalidConfirmationCodeException;
		}

		$user->confirmed = 1;
		$user->confirmation_code = null;

		$user->save();

		return Redirect::to('id'.$user->id);
	}

	public function settings(){
		$notify_msg = Auth::user()->notify_msg ? true : false;
		$notify_cmt = Auth::user()->notify_cmt ? true : false;

		return View::make('settings')
		->with('notify_msg', $notify_msg)
		->with('notify_cmt', $notify_cmt);
	}

	public function change_settings(){
		$d = Input::all();

		if(isset($d['notify_msg']))
			Auth::user()->notify_msg = 1;
		else
			Auth::user()->notify_msg = 0;

		if(isset($d['notify_cmt']))
			Auth::user()->notify_cmt = 1;
		else
			Auth::user()->notify_cmt = 0;

		Auth::user()->save();

		return Redirect::route('settings');
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


	public function profile_id($id){

		if(!$user = User::find($id)){
			App::abort(404);
		}

		if(Auth::check()){

			$authUser = Auth::user();

			if(intval($authUser->id)===$user->id){

				if($authUser->isReady()){
					return View::make('owners_profile')->with('id', $user->id);
				} else {
					return View::make('owners_profile')->with('id', $user->id)->with('not_ready', false);
				}

			} else {	

				if($authUser->isReady()){
					return View::make('layouts.guest_auth_profile')->with('id', $user->id);
				} else {
					return View::make('layouts.guest_auth_profile')->with('id', $user->id)->with('not_ready', true);
				}

			}
		}
		else if(Auth::guest())
			return View::make('guest_profile')->with('id', $user->id);

	}

	public function check_for_allow(){
		if(Auth::user()->isReady() && count(Auth::user()->posts)===0){
			return View::make('layouts.posts.add_post');
		} else {
			return 'not ready';
		}
	}

	public function login(){
		// if(Auth::check()) return View::make('home');
		$data = Input::all();
		$cred = ['email' => $data['login'],
							'password' => $data['password']];

		if(Auth::attempt($cred, true)){
			return Redirect::to(Auth::user()->login);
		}
	}

	public function forget(){
		Auth::logout();
		return Redirect::route('home');
	}

	public function edit_ava(){
		$validTypes = array('image/png', 'image/jpg', 'image/jpeg');
		if(Input::hasFile('avatar')){
			$f = Input::file('avatar');
			if($f->isValid()){
				$size = getimagesize($f);
				$w = $size[0];
				$h = $size[1];
				if($w+$h > 7000){
					return 'non';
				} else {
					if(array_search($f->getMimeType(), $validTypes)!==false){
						$tmp_name = md5($f->getFileName().Auth::id());
						$src = 'img/3d801aa532/';

						$name = $tmp_name . '.' . substr($f->getMimeType(), 6);

						$n = $src . $name;

						$img = Image::make($f);
						$w = $img->width();
						$h = $img->height();

						if($w>=$h){
							$img->widen(700,function($c){
								$c->upsize();
							})->save($n);
						} else {
							$img->heighten(500,function($c){
								$c->upsize();
							})->save($n);
						}

						Session::put('ava_temp', $n);

						return json_encode(array('h' => $img->height(), 'w' => $img->width(), 'path' => $n));
						// return $f->move('img/'.substr(md5('temp'),0,10), 'cs'.md5($d->getFileName()).'.'.substr($d->getMimeType(), 6));
					} else {
						return 'non';
					}
				}
			} else {
				return 'non';
			}
		} else {
			return 'non';
		}
	}

	public function delete_temp_ava(){
		if(Auth::check()){
			$f = Session::get('ava_temp');
			if(file_exists($f)) unlink($f);
			Session::forget('ava_temp');
		}
	}

	public function submit_ava(){
		if(Auth::check())
			$user = User::find(Auth::id());
		else return 'non';

		$d = Input::get('data');
		$d = json_decode($d);
		foreach ($d as $key) {
			if(!is_numeric($key)){
				return 'non';
			}
		}
		$tmp = Session::get('ava_temp');
		if($tmp !== '')
			$imgp = Session::get('ava_temp');
		else 
			return 'non';

		$img = Image::make($imgp);
		if($d->w < 150 && $d->h < 150) return 'fuckyoufool';
		if($d->x>$img->width() && $d->w>$img->width())
			return 'non';
		if($d->y>$img->height() && $d->h>$img->height())
			return 'non';
		
		$path = 'img/' . 'id' . Auth::id() . '/';
		$t = true;

		if (!file_exists($path) && !is_dir($path)) {
			$t = mkdir($path,0777,true);
		}

		if($t){
			try{
				$name_xl = md5(Auth::id() . time() . $imgp . 'xl') . '.jpg';
				$name_sm = md5(Auth::id() . time() . $imgp . 'sm') . '.jpg';

				$nxl = $path.$name_xl;
				$nsm = $path.$name_sm;

				$ava_xl = $user->ava_xl;
				$ava_sm = $user->ava_sm;

				if(empty($ava_xl)&&empty($ava_sm)){
					$img->crop($d->w,$d->h,$d->x,$d->y)->resize(200,200)->save($nxl, 100)
													->resize(60,60)->save($nsm, 80);

					$user->ava_xl = $nxl;									
					$user->ava_sm = $nsm;
					$user->save();

					return $nxl;						
				} else {
					if(file_exists($ava_xl)||file_exists($ava_sm)){
						unlink($ava_xl);
						unlink($ava_sm);
					}

					$img->crop($d->w,$d->h,$d->x,$d->y)->resize(200,200)->save($nxl, 100)
													->resize(60,60)->save($nsm, 80);

					$user->ava_xl = $nxl;									
					$user->ava_sm = $nsm;
					$user->save();

					return $nxl;
				}

			} catch(Exception $e){
				return $e;
			}
		} else {
			return 'non';
		}
	}

	public function edit_profile(){
		if(Auth::check())
			$user = User::find(Auth::id());
		else return 'non';

		$validTypes = array('pLogin', 'pName', 'pAge', 'pBDay', 'pTown', 'pAbout');

		$column = '';

		$d =  Input::get('data') ? Input::get('data') : 'non';
		$d = json_decode($d);

		if($d === 'non') return '404';

		if(count($d) === 1){
			$data = array();
			$key = '';
			foreach ($d as $k => $v) {
				if(array_search($k, $validTypes)===false){
					return 'non';
				} else {
					$data['data'] = $v;
					$key = $k;
				}
			}
				if($data['data']===''||$data['data']===0)
					return 'non';

				switch ($key) {
					case 'pLogin':
						$column = 'login';
						break;

					case 'pName':
						$column = 'name';
						break;

					case 'pAge':
						$column = 'age';
						break;

					case 'pTown':
						$column = 'town';
						break;

					case 'pAbout':
						$column = 'about';
						break;

					default:
						$column = 'non';
						break;
				}

				if($column === 'non') return 'non';

				
				if($column!=='non' && $column === 'age'){
					if(!is_numeric($data['data']))
						return 'non';
					if($data['data']>80)
						return 'non';
				}

				if($column!=='non' && $column === 'about'){
					$d = htmlentities(trim($data['data']));
					$d = preg_replace('/[\n]{2,}/mu', '<br><br>', $d);
					$d = preg_replace('/[\n]{1}/mu', '<br>', $d);
					$d = preg_replace('/[\s]{2,}/mu', ' ', $d);

					$user->about = $d;
					$user->save();
					return $d;
				}

				if($column!=='non' && $column === 'login'){
					if(preg_match_all('/[^0-9a-zа-я\.\_]|^[^0-9a-zа-я]|[^0-9a-zа-я]$/u', $data['data'])){
						return 'non';
					}
				}

				$user[$column] = htmlentities($data['data']);
				$user->save();
				echo 'ok';
		} else return 'non';
	}

	public function edit_login(){

		$d = json_decode(Input::get('data'));

		if(isset($d->login)){
			$data = array('data' => $d->login);

			if(preg_match_all('/[^0-9a-zа-я\.\_]|^[^0-9a-zа-я]|[^0-9a-zа-я]$/u', $data['data'])){
				return 'non';
			}

			$rules = [
				'data' => "required|unique:users,login"
			];

			$val = Validator::make($data, $rules);

			if($val->fails())
				// return 'login not unique';
				return 'non';
			return 'ok';
		} else {
			return 'fuck';
		}
	}

	public function submit_login(){
		$d = Input::all();
		if(isset($d['login'])){
			$data = array('data' => $d['login']);

			if(preg_match_all('/[^0-9a-zа-я\.\_]|^[^0-9a-zа-я]|[^0-9a-zа-я]$/u', $data['data'])){
				return 'non';
			}

			$rules = [
				'data' => "required|unique:users,login"
			];

			$val = Validator::make($data, $rules);

			if($val->fails())
				// return 'login not unique';
				return 'non';
			
			
			Auth::user()->login = $d['login'];
			Auth::user()->save();
			// return Auth::user()->login;
			return Redirect::to('/'.$d['login']);
		} else {
			return 'fuck';
		}
	}
}
