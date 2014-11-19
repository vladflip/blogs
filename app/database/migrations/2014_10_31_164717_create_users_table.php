<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	const TABLE_NAME = 'users';


	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');

			$t->string('login',45)->nullable();
			$t->string('email',100);
			$t->string('firstname',60);
			$t->string('lastname',60);
			$t->string('password',64);
			$t->rememberToken();
			$t->string('ava_xl',255);
			$t->string('ava_sm',255);
			$t->string('ava_xs', 255);

			$t->tinyInteger('age')->unsigned();
			$t->mediumInteger('rate')->unsigned();

			$t->string('about');
			$t->date('birthday');
			$t->string('town',60);

			$t->tinyInteger('mod_flag');
			$t->timestamps();

			$t->unique('login');
			$t->unique('email');
			$t->index('rate');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
