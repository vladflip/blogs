<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsImagesTable extends Migration {

	const TABLE_NAME = 'posts_images';

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');
			$t->integer('post_id')->unsigned();
			$t->string('src');
			$t->string('src_sm');

			$t->foreign('post_id')->references('id')
											->on('posts')
											->onDelete('cascade')
											->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
