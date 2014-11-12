<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	const TABLE_NAME = 'comments';

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');
			$t->integer('post')->unsigned();
			$t->integer('user')->unsigned();
			$t->timestamp('date');
			$t->tinyInteger('mod_flag');

			$t->foreign('post')->references('id')->on('posts')
											->onDelete('cascade')
											->onUpdate('no action');
			$t->foreign('user')->references('id')->on('users')
											->onDelete('cascade')
											->onUpdate('no action');
		});
	}

	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
