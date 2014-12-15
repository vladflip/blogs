<?php

class PostController extends BaseController {

	public function create()
	{
		$d = Input::all();

		$r = ['header'=>'required', 'content' => 'required'];

		$val = Validator::make($d, $r);

		if($val->fails()){
			return Redirect::to(Auth::user()->login);
		} else {


			// return nl2br($d['content']);

			$head = htmlentities(trim($d['header']));
			$head = preg_replace('/[\n]{2,}/mu', '<br><br>', $head);
			$head = preg_replace('/[\n]{1}/mu', '<br>', $head);
			$head = preg_replace('/[\s]{2,}/mu', ' ', $head);


			$con = htmlentities(trim($d['content']));
			$con = preg_replace("/[\r\n]{2,}/mu", '<br><br>', $con);
			// $con = preg_replace("/[\r\n]{1}/mu", '<br>', $con);
			$con = preg_replace('/[\s]{2,}/mu', ' ', $con);

			// return explode(" ",$con);

			$p = Post::create([
					'user_id' => Auth::id(),
					'header' => $head,
					'content' => $con
				]);
			return Redirect::to(Auth::user()->login);
		}
	}

	public function get_post($id){

		if(Auth::check()){
			if(Auth::user()->isReady())
				return View::make('post')->with('post', 
								Post::with(array('comments'=>function($q){

									$q->with('user')
										->with('likes')
										->orderBy('id', 'DESC');

								}))->find($id));
			else
				return View::make('guest_post')->with('post', 
								Post::with(array('comments'=>function($q){

									$q->with('user')
										->with('likes')
										->orderBy('id', 'DESC');

								}))->find($id))->with('auth', true);
		} else
			return View::make('guest_post')->with('post', 
									Post::with(array('comments'=>function($q){

										$q->with('user')
											->with('likes')
											->orderBy('id', 'DESC');

									}))->find($id));

	}

	public function like(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$post = Post::find($d->id);
		$post->likes()->attach(Auth::id());
	}

	public function dislike(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$post = Post::find($d->id);
		$post->likes()->detach(Auth::id());
	}
}
