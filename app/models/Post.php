<?php

class Post extends Eloquent{

	protected $fillable = ['user_id','header','content','mod_flag'];

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function comments(){
		return $this->hasMany('Comment', 'post_id');
	}

	public function likes(){
		return $this->belongsToMany('User', 'posts_likes', 'post_liked', 'user_liked')
			->withPivot('post_liked');
	}

}