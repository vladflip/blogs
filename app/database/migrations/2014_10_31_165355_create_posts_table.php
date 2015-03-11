<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	const TABLE_NAME = 'posts';

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');

			$t->integer('user_id')->unsigned();

			$t->string('header',255);
			$t->text('content');
			// $t->tinyInteger('mod_flag');
			$t->timestamps();

			$t->foreign('user_id')->references('id')->on('users')
											->onDelete('cascade')
											->onUpdate('no action');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
