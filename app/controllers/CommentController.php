<?php

class CommentController extends BaseController {

	// public function create(){

	// 	$d = json_decode(Input::get('data'));

	// 	if($d->val === '') return 'non';
		
	// 	if(md5($d->id.csrf_token())!==$d->hash){
	// 		return 'fuck';
	// 	}
	// 	$r = htmlentities(trim($d->val));
	// 	$r = preg_replace('/[\r\n]{2,}/mu', '<br><br>', $r);
	// 	$r = preg_replace('/[\r\n]{1}/mu', '<br>', $r);
	// 	$r = preg_replace('/[\s]{2,}/mu', ' ', $r);
		
	// 	$comment = Comment::create([
	// 			'content' => $r,
	// 			'user_id' => Auth::id(),
	// 			'post_id' => $d->id
	// 		]);

	// 	$comment->user->rate += 2;
	// 	$comment->user->save();

	// 	return View::make('create_comment')->with('fuck', 'fuck')
	// 									->with('user', Auth::user());
	// }

	public function delete(){
		$d = json_decode(Input::get('data'));
		if(md5($d->id.Auth::id())===$d->hash){
			$comment = Comment::find($d->id);
			if($comment->user_id == Auth::id()){
				$user = User::find($comment->user_id);
				$user->rate -= 2;

				// decrease rate from likes
				foreach ($comment->likes as $k => $v) {
					if($v->id != $comment->user_id){
						$user->rate--;
					}
				}
				$user->save();

				$comment->delete();

			}
		}

	}

	public function create_wall_comment(){
				

		$d = json_decode(Input::get('data'));
		
		if($d->val === '') return 'non';

		if(md5($d->id.csrf_token())!==$d->hash){
			return 'fuck';
		}
		
		$r = htmlentities(trim($d->val));
		$r = preg_replace('/[\r\n]{2,}/mu', '<br><br>', $r);
		$r = preg_replace('/[\r\n]{1}/mu', '<br>', $r);
		$r = preg_replace('/[\s]{2,}/mu', ' ', $r);

		$comment = new Comment([
				'content' => $r,
				'user_id' => Auth::user()->id,
				'post_id' => $d->id
			]);

		if(isset($d->to) && isset($d->h)){
			if(!is_numeric($d->to))
				return 'fuck';

			if(md5($d->to.$d->id)===$d->h){
				$cmt = Comment::with('user')->find($d->to);
				if($cmt->post_id == $d->id) {
					$comment->parent_id = $d->to;
					$cmt->user->notify('cmt', Post::whereId('1')->select('header', 'id')->first());
				}
			}
		}

		$comment->user->rate += 2;
		$comment->user->save();
		$comment->save();

		return View::make('layouts.posts.create_wall_comment')->with('comment', $comment)
										->with('user', Auth::user());
	}

	public function like(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$cmt = Comment::find($d->id);
		$cmt->likes()->attach(Auth::id());

		if($cmt->user->id!=Auth::id()){
			$cmt->user->rate += 1;
			$cmt->user->save();
		}
	}

	public function dislike(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$cmt = Comment::find($d->id);
		$cmt->likes()->detach(Auth::id());

		if($cmt->user->id!=Auth::id()){
			$cmt->user->rate -= 1;
			$cmt->user->save();
		}
	}

}