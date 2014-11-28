<?php

class PostController extends BaseController {

	public function create()
	{
		$d = Input::all();

		$r = ['header'=>'required', 'content' => 'required'];

		$val = Validator::make($d, $r);

		if($val->fails()){
			return Redirect::to('id'.Auth::id());
		} else {
			$p = Post::create([
					'user_posted' => Auth::id(),
					'header' => $d['header'],
					'content' => $d['content']
				]);
			return Redirect::to('id'.Auth::id());
		}
	}

	public function get_post($id){
		return View::make('post')->with('post', Post::with('comments')->find($id));
	}
}
