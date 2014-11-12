<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsLikesTable extends Migration {

	const TABLE_NAME = 'posts_likes';
	
	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->integer('post_liked')->unsigned();
			$t->integer('user_liked')->unsigned();

			$t->primary(array('post_liked','user_liked'));

			$t->foreign('post_liked')->references('id')->on('posts')
											->onDelete('cascade')
											->onUpdate('no action');
			$t->foreign('user_liked')->references('id')->on('users')
											->onDelete('cascade')
											->onUpdate('no action');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
