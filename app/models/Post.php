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
		return $this->belongsToMany('User', 'posts_likes', 'post_liked', 'user_liked');
	}

	public function images(){
		return $this->hasMany('PostImage', 'post_id');
	}

	public static function attached() {
		return self::whereAttached(1)->get();
	}

	public static function getByLikes($n){
		$arr = Post::with('likes')->has('likes')->get();
		$arr2 = array();

		$header = array();
		$cnt = array();

		for($i=0;$i<count($arr);$i++){
			$arr2[] = array('header' => $arr[$i]->header, 'cnt' => count($arr[$i]->likes), 'id' => $arr[$i]->id);
			$header[] = $arr[$i]->header;
			$cnt[] = count($arr[$i]->likes);
		}
		array_multisort($cnt, SORT_DESC, $header, SORT_ASC, $arr2);

		return $arr2;
	}

}