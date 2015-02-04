<?php

class AdminController extends BaseController {

	public function posts(){
		$posts = Post::with('user','comments', 'likes')->get();

		return View::make('admin.posts')->with('posts', $posts);
	}

	public function users(){

		$users = User::with('posts', 'comments')->get();

		return View::make('admin.users')->with('users', $users);
	}

}