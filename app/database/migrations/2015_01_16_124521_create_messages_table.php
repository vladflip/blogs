<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	const TABLE_NAME = 'messages';

	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');
			$t->text('msg');

			$t->integer('to_user')->unsigned();
			$t->integer('from_user')->unsigned();

			$t->boolean('status');

			$t->timestamps();

			$t->foreign('to_user')->references('id')
											->on('users')
											->onDelete('no action')
											->onUpdate('no action');
			$t->foreign('from_user')->references('id')
											->on('users')
											->onDelete('no action')
											->onUpdate('no action');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
