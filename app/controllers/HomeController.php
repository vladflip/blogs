<?php

class HomeController extends BaseController {

	public function home()
	{
		if(Auth::check()){
			if(Auth::user()->isReady())
				return View::make('home')->with('posts', Post::with('user', 'comments', 'likes')
					->orderBy('id','DESC')->get());
			else
				return View::make('guest_home')->with('posts', Post::with('user', 'comments', 'likes')
					->orderBy('id','DESC')->get())->with('auth', true);
		}
		else 
			return View::make('guest_home')->with('posts', Post::with('user', 'comments', 'likes')
				->orderBy('id','DESC')->get());
	}
	
}
