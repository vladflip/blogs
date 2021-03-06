<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	const TABLE_NAME = 'users';


	public function up()
	{
		Schema::create(self::TABLE_NAME, function($t){
			$t->increments('id');

			// $t->string('login',45)->nullable();
			$t->string('email',100);
			$t->string('name')->nullable();
			$t->string('password',64);

			$t->boolean('confirmed')->default(0);
			$t->string('confirmation_code')->nullable();

			$t->boolean('notify_msg')->default(1);
			$t->boolean('notify_cmt')->default(1);

			$t->dateTime('new_logged_in');
			$t->dateTime('last_logged_in');
			
			$t->rememberToken();
			$t->string('ava_xl',255);
			$t->string('ava_sm',255);

			$t->tinyInteger('age')->unsigned();
			$t->mediumInteger('rate')->unsigned();

			$t->string('about')->nullable();
			// $t->date('birthday');
			$t->string('town',60)->nullable();

			$t->boolean('admin')->default(0);
			$t->boolean('banned')->default(0);

			$t->timestamps();

			// $t->unique('login');
			$t->unique('email');
			$t->index('rate');
		});
	}

	
	public function down()
	{
		Schema::drop(self::TABLE_NAME);
	}

}
