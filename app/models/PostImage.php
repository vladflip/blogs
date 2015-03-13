<?php

class PostImage extends Eloquent {

	protected $table = 'posts_images';

	protected $fillable = ['src', 'src_sm'];

	public $timestamps = false;

	public function post() {
		return $this->belongsTo('Post', 'post_id');
	}

}