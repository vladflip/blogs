<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		Eloquent::unguard();

		

		$this->call('UsersSeeder');

		$this->call('PostsSeeder');

		$this->call('CommentsSeeder');

		$this->call('MessagesSeeder');

		$this->call('LikesSeeder');

		$this->call('PostImagesSeeder');
	}

}

class FF {
	public static function get() {
		return Faker\Factory::create();
	}
}

class UsersSeeder extends Seeder{

	public function run() {

		$f = FF::get();

		for($i=0;$i<10;$i++){
			$now = Carbon::now();

			User::create([

					'email' => $f->email,
					'name' => $f->name(),
					'password' => $f->word,
					'confirmed' => 1,
					'notify_msg' => 0,
					'notify_cmt' => 0,
					'new_logged_in' => $now,
					'last_logged_in' => $now,
					'ava_xl' => $f->imageUrl(150, 150),
					'ava_sm' => $f->imageUrl(60, 60),
					'age' => $f->numberBetween(18, 50),
					'rate' => $f->randomDigitNotNull,
					'about' => $f->sentence,
					'town' => $f->word,
					'admin' => 0,
					'banned' => 0

				]);
		}

		$p = Hash::make('admin');

		$now = Carbon::now();

		User::create([

				'email' => 'admin@mail.ru',
				'name' => 'admin',
				'password' => $p,
				'confirmed' => 1,
				'notify_msg' => 0,
				'notify_cmt' => 0,
				'new_logged_in' => $now,
				'last_logged_in' => $now,
				'ava_xl' => $f->imageUrl(150, 150),
				'ava_sm' => $f->imageUrl(60, 60),
				'age' => $f->numberBetween(18, 50),
				'rate' => $f->randomDigitNotNull,
				'about' => $f->sentence,
				'town' => $f->word,
				'admin' => 1,
				'banned' => 0

			]);
	}

}

class PostsSeeder extends Seeder{

	public function run() {

		$f = FF::get();

		for($i=0;$i<10;$i++){
			Post::create([

					'user_id' => $f->numberBetween(1, 9),
					'header' => $f->sentence(5),
					'content' => $f->paragraph(4),
					'attached' => $i < 5 ? 1 : 0

				]);
		}



	}

}

class CommentsSeeder extends Seeder{

	public function run() {

		$f = FF::get();

		for($i=1;$i<20;$i++){
			Comment::create([

					'post_id' => $f->numberBetween(1, 9),
					'user_id' => $f->numberBetween(1, 9),
					'parent_id' => $i > 1 ? $i-1 : 0,
					'content' => $f->sentence(10)

				]);
		}
	}
}

class MessagesSeeder extends Seeder{

	public function run() {

		$f = FF::get();

		$u = User::where('email', '=', 'admin@mail.ru')->first();

		for($i=1;$i<20;$i++){
			Message::create([
					'msg' => $f->sentence(7),
					'to_user' => $u->id,
					'from_user' => $f->numberBetween(1, 9),
					'status' => 0
				]);
			Message::create([
					'msg' => $f->sentence(7),
					'to_user' => $f->numberBetween(1, 9),
					'from_user' => $u->id,
					'status' => $f->numberBetween(0, 1)
				]);
		}
	}
}

class LikesSeeder extends Seeder{

	public function run() {

		$f = FF::get();

		for($i=1;$i<10;$i++){
			DB::table('comments_likes')->insert([
					'comment_liked' => $i,
					'user_liked' => $i
				]);
			DB::table('posts_likes')->insert([
					'post_liked' => $i,
					'user_liked' => $i
				]);
		}	
	}
}

class PostImagesSeeder extends Seeder{

	public function run() {

		$f = FF::get();

		for ($i=1; $i < 11; $i++) { 
			for ($j=1; $j < rand(1, 10); $j++) { 
				PostImage::create([
					'src' => $f->imageUrl(1200, 800),
					'src_sm' => $f->imageUrl(600, 200),
					'post_id' => $i
				]);
			}
		}
	}
}