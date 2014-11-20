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
		if(!User::find($id)){
			return 404;
		}
		if(Auth::check())
			return View::make('profile')->with('id', $id);
		else if(Auth::guest())
			return View::make('guest_profile')->with('id', $id);
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
				$name_xs = md5(Auth::id() . time() . $imgp . 'xs') . '.jpg';

				$nxl = $path.$name_xl;
				$nsm = $path.$name_sm;
				$nxs = $path.$name_xs;

				$ava_xl = $user->ava_xl;
				$ava_sm = $user->ava_sm;
				$ava_xs = $user->ava_xs;

				if(empty($ava_xl)&&empty($ava_sm)&&empty($ava_xs)){
					$img->crop($d->w,$d->h,$d->x,$d->y)->resize(150,150)->save($nxl, 70)
													->resize(50,50)->save($nsm, 70)
													->resize(32,32)->save($nxs, 70);

					$user->ava_xl = $nxl;									
					$user->ava_sm = $nsm;									
					$user->ava_xs = $nxs;
					$user->save();

					return $nxl;						
				} else {
					if(file_exists($ava_xl)||file_exists($ava_sm)||file_exists($ava_xs)){
						unlink($ava_xl);
						unlink($ava_sm);
						unlink($ava_xs);
					}

					$img->crop($d->w,$d->h,$d->x,$d->y)->resize(150,150)->save($nxl, 100)
													->resize(50,50)->save($nsm, 80)
													->resize(32,32)->save($nxs, 70);

					$user->ava_xl = $nxl;									
					$user->ava_sm = $nsm;									
					$user->ava_xs = $nxs;
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

		$validTypes = array('pLogin', 'pFirstName', 'pLastName', 'pAge', 'pBDay', 'pTown');

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

				switch ($key) {
					case 'pLogin':
						$column = 'login';
						break;

					case 'pFirstName':
						$column = 'firstname';
						break;
					
					case 'pLastName':
						$column = 'lastname';
						break;

					case 'pAge':
						$column = 'age';
						break;

					case 'pTown':
						$column = 'town';
						break;


					default:
						$column = 'non';
						break;
				}

				if($column!=='non' && $column === 'login'){
					$rules = [
						'data' => "unique:users,login"
					];

					$val = Validator::make($data, $rules);

					if($val->fails())
						return 'login not unique';
				}

				$user[$column] = $data['data'];
				$user->save();
			}
		} else return 'non';
	}
}