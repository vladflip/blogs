<?php

class MessageController extends BaseController {

	public function index(){

		// $ms = Message::create([
		// 		'msg' => 'second msg 222',
		// 		'to_user' => 1,
		// 		'from_user' => 2,
		// 		'status' => 0
		// 	]);

		$msgs = Message::with('receiver')
			->where('to_user', '=', Auth::id())
			->get();

		foreach($msgs as $k => $v){
			$v->status = 1;
			$v->save();
		}


		return View::make('messages')->with('msgs', $msgs);
	}

	public function send(){

		$d = Input::all();

		$msg = htmlentities(trim($d['message']));

		if(!intval($d['receiver'])>0){
			return 'fuck';
		}

		if(User::find($d['receiver'])){
			Message::create([
					'msg' => $msg,
					'to_user' => $d['receiver'],
					'from_user' => Auth::id(),
					'status' => 0
				]);
		}
		return Redirect::back();
		
	}

}