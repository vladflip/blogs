<?php

class Comment extends Eloquent{

	protected $fillable = ['post','user','mod_flag', 'content'];

	public function user(){
		return $this->belongsTo('User', 'user');
	}

	public function post(){
		return $this->belongsTo('Post', 'post');
	}

	public function likes(){
		return $this->belongsToMany('User', 'comments_likes', 'comment_liked', 'user_liked');
	}
}