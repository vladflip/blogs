<?php

class CommentController extends BaseController {

	public function create(){

		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.csrf_token())===$d->hash){
			// echo 'adsf';
		}

		$r = htmlentities(trim($d->val));
		$r = preg_replace('/[\n]{2,}/mu', '<br><br>', $r);
		$r = preg_replace('/[\n]{1}/mu', '<br>', $r);
		$r = preg_replace('/[\s]{2,}/mu', ' ', $r);
		
		$comment = Comment::create([
				'content' => $r,
				'user_id' => Auth::id(),
				'post_id' => $d->id
			]);

		return View::make('create_comment')->with('cmt', $comment)
										->with('user', Auth::user());
	}

	public function like(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$cmt = Comment::find($d->id);
		$cmt->likes()->attach(Auth::id());
	}

	public function dislike(){
		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.$d->id)===$d->hash){
			echo 'ok';
		} else return 'non';

		$cmt = Comment::find($d->id);
		$cmt->likes()->detach(Auth::id());
	}

}