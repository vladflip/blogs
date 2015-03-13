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


			$con =  nl2br(htmlentities(trim($d['content'])));

			$con =  preg_replace('/\\r\\n/mu', '', $con);
			$con =  preg_replace('/(<br \/>)/mu', '<br>', $con);
			$con =  preg_replace('/(<br>){3,}/mu', '<br><br>', $con);

			$head = htmlentities(trim($d['header']));
			// $head = preg_replace('/[\n]{2,}/mu', '<br><br>', $head);
			// $head = preg_replace('/[\n]{1}/mu', '<br>', $head);
			// $head = preg_replace('/[\s]{2,}/mu', ' ', $head);


			// $con = htmlentities(trim($d['content']));
			// $con = preg_replace("/[\r\n]{2,}/mu", '<br><br>', $con);
			// // $con = preg_replace("/[\r\n]{1}/mu", '<br>', $con);
			// $con = preg_replace('/[\s]{2,}/mu', ' ', $con);

			// var_dump($str);

			// return explode(" ",$con);

			$p = Post::create([
					'user_id' => Auth::id(),
					'header' => $head,
					'content' => $con
				]);

			$p->user->rate += 3;
			$p->user->save();

			if(Input::hasFile('imgs')){
				$validTypes = array('image/png', 'image/jpg', 'image/jpeg');

				$imgs = Input::file('imgs');

				$src = 'img/id' . Auth::id() . '/asset/';

				foreach ($imgs as $key => $val) {
					if(array_search($val->getMimeType(), $validTypes)!==false){
						$size = getimagesize($val);
						$w = $size[0];
						$h = $size[1];
						if($w+$h > 7000){
							return 'non';
						} else {

							$name = md5(
									$val->getClientOriginalName() .
									md5($val->getSize()) .
									$val->getMimeType() .
									time()
								);
							$name2 = md5(
									$val->getClientOriginalName() .
									$val->getSize() .
									md5($val->getMimeType()) .
									time()
								);

							$f1 = substr($name, -2) . '/';
							$f2 = substr($name, -3) . '/';

							$tsrc = $src . $f1 . $f2;

							if (!file_exists($tsrc) && !is_dir($tsrc)) {
								$t = mkdir($tsrc, 0777, true);
							}

							$path = $tsrc  . $name . '.' . 'jpg';

							$path2 = $tsrc  . $name2 . '.' . 'jpg';

							$img = Image::make($val);

							$img->save( $path, 100 );

							if($w>600){
								$img->widen(600);
							}

							$img->save( $path2, 100 );

							$pi = new PostImage([
									'src' => $path,
									'src_sm' => $path2
								]);
							$pi->post()->associate($p);
							$pi->save();

						}
					} else {
						return 'fuck';
					}
				}
			}
			return Redirect::to(Auth::user()->url());
		}
	}

	public function get_post($id){
		if(Auth::check()){
			if(Auth::user()->isReady())
				return View::make('inner_post')->with('post', 
								Post::with(array('comments'=>function($q){

									$q->with('user')
										->with('likes')
										->orderBy('id', 'DESC');

								}))->find($id));
			else
				return View::make('guest_inner_post')->with('post', 
								Post::with(array('comments'=>function($q){

									$q->with('user')
										->with('likes')
										->orderBy('id', 'DESC');

								}))->find($id));
		} else
			return View::make('guest_inner_post')->with('post', 
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
											->with('images')

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
											->with('images')

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
				
				->with('images')
				->with('user')

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

				->with('images')
				->with('user')

				->orderBy('id','DESC')
				->with('likes')
				->skip($cnt)
				->take(5)->get());
		}
	}

	public function delete(){
		$d = json_decode(Input::get('data'));
		if(md5($d->id.Auth::id())===$d->hash){
			$post = Post::find($d->id);
			if($post->user_id == Auth::id()){
				$user = User::find($post->user_id);
				$user->rate -= 3;

				// decrease rate from likes
				foreach ($post->likes as $k => $v) {
					if($v->id != $post->user_id){
						$user->rate--;
					}
				}

				//decrease rate from comments and its likes
				foreach ($post->comments as $k => $v) {
					if($v->user_id == $post->user_id){ // if its own comments
						$user->rate -= 2;

						foreach ($v->likes as $key => $val) {
							if($val->id != $v->user_id){
								$user->rate--;
							}
						}
					}
				}

				$user->save();

				$post->delete();
			}
		}
	}

	public function like(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$post = Post::find($d->id);
		$post->likes()->attach(Auth::id());

		if($post->user->id!=Auth::id()){
			$post->user->rate += 1;
			$post->user->save();
		}
	}

	public function dislike(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$post = Post::find($d->id);
		$post->likes()->detach(Auth::id());

		if($post->user->id!=Auth::id()){
			$post->user->rate -= 1;
			$post->user->save();
		}
	}
}
