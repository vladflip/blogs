<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$f = Faker\Factory::create();

		Eloquent::unguard();

		for($i=1;$i<20;$i++){
			User::create([
					'firstname' => $f->firstnameFemale,
					'lastname' => $f->lastName,
					'email' => $f->email,
					'ava_xl' => $f->imageUrl(150,150),
					'age' => $f->randomDigit
				]);
			$p = Post::create([
					'user_posted' => $i,
					'header' => $f->sentence,
					'content' => $f->paragraph(4)
				]);
			$p->likes()->attach($i);
			$c = Comment::create([
					'post' => $i+1,
					'user' => $i,
					'content' => $f->paragraph
				]);
			$c->likes()->attach($i);
		}
		// $this->call('UserTableSeeder');
	}

}
