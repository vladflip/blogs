<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsImagesTable extends Migration {

	const TABLE_NAME = 'comments_images';
	

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');
			$t->integer('comment_attach')->unsigned();
			$t->string('uri');

			$t->foreign('comment_attach')->references('id')
											->on('comments')
											->onDelete('cascade')
											->onUpdate('no action');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
