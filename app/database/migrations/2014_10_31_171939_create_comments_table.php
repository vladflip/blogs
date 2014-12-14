<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	const TABLE_NAME = 'comments';

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');
			$t->integer('post_id')->unsigned();
			$t->integer('user_id')->unsigned();
			$t->text('content');
			$t->tinyInteger('mod_flag');

			$t->foreign('post_id')->references('id')->on('posts')
											->onDelete('cascade')
											->onUpdate('no action');
			$t->foreign('user_id')->references('id')->on('users')
											->onDelete('cascade')
											->onUpdate('no action');
			$t->timestamps();
		});
	}

	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
