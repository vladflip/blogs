<?php

class HomeController extends BaseController {

	public function home()
	{
		if(Auth::check()){
			if(Auth::user()->isReady()){
				return View::make('home')->with('posts', Post::with(['comments' => function($r){
						$r->orderBy('id', 'DESC')
						->with('likes')
						->with('user');
				}])

				->orderBy('id','DESC')
				->with('likes')
				->take(5)->get())
				->with('u_rate', User::take(5)->orderBy('rate', 'DESC')->get())
				->with('popular', Post::getByLikes(5));
			}
			else
				return View::make('guest_home')->with('posts', Post::with(['comments' => function($r){
						$r->orderBy('id', 'DESC')
						->with('likes')
						->with('user');
				}])

				->orderBy('id','DESC')
				->with('likes')
				->take(5)->get())
				->with('u_rate', User::take(5)->orderBy('rate', 'DESC')->get())
				->with('popular', Post::getByLikes(5));
		}
		else 
			return View::make('guest_home')->with('posts', Post::with(['comments' => function($r){
						$r->orderBy('id', 'DESC')
						->with('likes')
						->with('user');
				}])

				->orderBy('id','DESC')
				->with('likes')
				->take(5)->get())
				->with('u_rate', User::take(5)->orderBy('rate', 'DESC')->get())
				->with('popular', Post::getByLikes(5));
	}
	
}
