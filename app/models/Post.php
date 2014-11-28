<?php

class Post extends Eloquent{

	protected $fillable = ['user_posted','header','content','mod_flag'];

	public function user(){
		return $this->belongsTo('User', 'user_posted');
	}

	public function comments(){
		return $this->hasMany('Comment', 'post');
	}

	public function likes(){
		return $this->belongsToMany('User', 'posts_likes', 'post_liked', 'user_liked')
			->withPivot('post_liked');
	}

}