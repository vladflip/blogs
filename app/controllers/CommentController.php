<?php

class CommentController extends BaseController {

	public function create(){

		$d = json_decode(Input::get('data'));
		
		if(md5($d->id.csrf_token())===$d->hash){
			echo 'adsf';
		}
		
		Comment::create([
				'content' => $d->val,
				'user' => Auth::id(),
				'post' => $d->id
			]);
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