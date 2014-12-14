<?php

class Comment extends Eloquent{

	protected $fillable = ['post_id','user_id','mod_flag', 'content'];

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function post(){
		return $this->belongsTo('Post', 'post_id');
	}

	public function likes(){
		return $this->belongsToMany('User', 'comments_likes', 'comment_liked', 'user_liked');
	}
}