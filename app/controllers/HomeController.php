<?php

class HomeController extends BaseController {

	public function home()
	{
		if(Auth::check())
			return View::make('home')->with('posts', Post::with('user', 'comments', 'likes')->orderBy('id','DESC')->get());
		else 
			return View::make('guest_home')->with('posts', Post::all());
	}
	
}
