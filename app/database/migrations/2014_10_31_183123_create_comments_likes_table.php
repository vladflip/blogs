<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsLikesTable extends Migration {

	const TABLE_NAME = 'comments_likes';

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->integer('comment_liked')->unsigned();
			$t->integer('user_liked')->unsigned();

			$t->primary(array('comment_liked','user_liked'));

			$t->foreign('comment_liked')->references('id')
											->on('comments')
											->onDelete('cascade')
											->onUpdate('no action');
			$t->foreign('user_liked')->references('id')
											->on('users')
											->onDelete('cascade')
											->onUpdate('no action');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
