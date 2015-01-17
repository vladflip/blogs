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

}