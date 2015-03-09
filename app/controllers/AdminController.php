<?php

class AdminController extends BaseController {

	public function posts(){
		$posts = Post::with('user','comments', 'likes')->orderBy('id', 'DESC')->get();

		return View::make('admin.posts')->with('posts', $posts);
	}

	public function users(){

		$users = User::with('posts', 'comments')->orderBy('id', 'DESC')->get();

		return View::make('admin.users')->with('users', $users);

	}

	public function deletePost(){
		$id = json_decode(Input::get('data'));

		if(Post::destroy($id->id)){
			return 'ok';
		}

	}

	public function banUser(){
		$id = json_decode(Input::get('data'));
		$user = User::find($id->id);

		if($user->banned())
			$user->banned = 0;
		else
			$user->banned = 1;

		$user->save();

		echo 'ok';
	}

}