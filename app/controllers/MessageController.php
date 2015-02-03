<?php

class MessageController extends BaseController {

	public function index(){

		// $ms = Message::create([
		// 		'msg' => 'second msg 222',
		// 		'to_user' => 1,
		// 		'from_user' => 2,
		// 		'status' => 0
		// 	]);

		$in = Message::where('to_user', '=', Auth::id())
			->orderBy('id', 'DESC')
			->get();

		$out = Message::where('from_user', '=', Auth::id())
			->orderBy('id', 'DESC')
			->get();
		

		foreach($in as $k => $v){
			$v->status = 1;
			$v->save();
		}

		return View::make('messages')->with('in', $in)->with('out', $out);
	}

	public function send(){

		$d = Input::all();

		$msg = htmlentities(trim($d['message']));

		if(!intval($d['receiver'])>0){
			return 'fuck';
		}

		if($user = User::find($d['receiver'])){
			Message::create([
					'msg' => $msg,
					'to_user' => $d['receiver'],
					'from_user' => Auth::id(),
					'status' => 0
				]);
			$user->notify('msg', $user);
		}
		return Redirect::back();
		
	}

}