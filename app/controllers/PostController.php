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


			$str =  nl2br($d['content']);

			// return preg_replace('/[<br \/>]{3,}/mu', '<br>', $str);

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
			$authUser = Auth::user();
			if($authUser->isReady())
				return View::make('post')->with('post', 
								Post::with(array('comments'=>function($q){

									$q->with('user')
										->with('likes')
										->orderBy('id', 'DESC');

								}))->find($id))->with('authUser', $authUser);
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

	public function load_more(){
		$d = json_decode(Input::get('data'));
		$cnt = $d->cnt;
		// return $cnt;
		if(!is_numeric($d->cnt)&&!is_numeric($d->id)) return 'fuck';
		if(Auth::check())
			return View::make('layouts.posts.wall_posts')->with('user',
				User::with(['posts'=>function($q) use ($cnt){

										$q->with('likes')

											->with(['comments' => function($q2){
												$q2->with('likes')
													->with('user')
													->orderBy('id', 'DESC');
											}])
											->orderBy('id', 'DESC')
											->skip($cnt)
											->take(5);

									}])->find($d->id));
		else{
			return View::make('layouts.posts.guest.wall_posts')->with('user',
				User::with(['posts'=>function($q) use ($cnt){

										$q->with('likes')

											->with(['comments' => function($q2){
												$q2->with('likes')
													->with('user')
													->orderBy('id', 'DESC');
											}])
											->orderBy('id', 'DESC')
											->skip($cnt)
											->take(5);

									}])->find($d->id));
		}

	}

	public function load_more_main(){
		$d = json_decode(Input::get('data'));
		$cnt = $d->cnt;
		if(!is_numeric($d->cnt)) return 'fuck';
		if(Auth::check())
			return View::make('layouts.posts.main.wall_posts')
			->with('posts', Post::with(['comments' => function($r) use($cnt){
						$r->orderBy('id', 'DESC')
						->with('likes')
						->with('user');
				}])

				->orderBy('id','DESC')
				->with('likes')
				->skip($cnt)
				->take(5)->get());
		else{
			return View::make('layouts.posts.main.guest.wall_posts')
			->with('posts', Post::with(['comments' => function($r) use($cnt){
						$r->orderBy('id', 'DESC')
						->with('likes')
						->with('user');
				}])

				->orderBy('id','DESC')
				->with('likes')
				->skip($cnt)
				->take(5)->get());
		}
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
