<?php


// ******************************************* USERs
Route::get('/', [
	'as' => 'home', 
	'uses' => 'HomeController@home'
]);

Route::group(array('before' => 'csrf'), function(){

	Route::post('/forget', ['as' => 'forget', 'uses' => 'UserController@forget']);

	Route::post('/edit-profile', ['as' => 'edit_profile', 'uses' => 'UserController@edit_profile']);

	Route::post('/edit-ava' , ['as' => 'edit_ava', 'uses' => 'UserController@edit_ava']);

	Route::post('/delete-ava', 'UserController@delete_temp_ava');

	Route::post('/submit-ava', ['as' => 'submit_ava', 'uses' => 'UserController@submit_ava']);

	Route::get('/like-post', ['as' => 'like_post', 'uses' => 'PostController@like']);

	Route::get('/dislike-post', ['as' => 'dislike_post', 'uses' => 'PostController@dislike']);

	Route::post('/delete-comment', ['as' => 'add_comment', 'uses' => 'CommentController@delete']);

	Route::get('/like-comment', ['as' => 'like_comment', 'uses' => 'CommentController@like']);

	Route::get('/dislike-comment', ['as' => 'dislike_comment', 'uses' => 'CommentController@dislike']);

	Route::post('/create-wall-comment', ['as' => 'create_wall_comment', 'uses' => 'CommentController@create_wall_comment']);

});



Route::get('/id{id}',['as' => 'profile', 'uses' => 'UserController@profile_id'])
	->where('id','[0-9]+');

Route::post('/login', ['as' => 'login', 'uses' => 'UserController@login']);

Route::post('/register', ['as' => 'register', 'uses' => 'UserController@register']);

Route::post('/ajax-check-email', array('as'=>'ajax_check_email', 'uses' => 'UserController@ajax_check_email'));

Route::get('/check-for-allow-posting', ['as' => 'check_for_allow', 'uses' => 'UserController@check_for_allow']);
// Route::post('/edit-login', ['as' => 'edit_login', 'uses' => 'UserController@edit_login']);
// Route::post('/submit-login', ['before' => 'csrf','as' => 'submit_login', 'uses' => 'UserController@submit_login']);

Route::get('/register/verify/{code}', ['as' => 'verify_email', 'uses' => 'UserController@verify']);

Route::get('/настройки', [ 'as' => 'settings', 'uses' => 'UserController@settings']);
Route::post('/change_settings', ['before' => 'csrf', 'as' => 'change_settings', 'uses' => 'UserController@change_settings']);



// *********************************************** POSTs

Route::post('/creat-post', ['as' => 'create_post', 'uses' => 'PostController@create']);
Route::post('/delete-post', ['as' => 'delete_post', 'uses' => 'PostController@delete']);

Route::get('/p', function(){
	// Post::create([
	// 		'user_posted' => 1,
	// 		'header' => 'Lorem ipsum dolor sit amet, consectetur adipisicing.',
	// 		'content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem placeat itaque veritatis architecto doloribus sit aspernatur ratione, minus earum explicabo, cupiditate voluptate hic minima quas vel. Sed voluptatem, earum totam.',
	// 	]);
	// Comment::create([
	// 		'post' => 2,
	// 		'user' => 1,
	// 	]);
	
	// $u = Post::find(2);
	// $u->likes()->attach(6);
	

	// $p = Post::find(7);

	// dd( $p->likes[0]->pivot );
	
	// $u = User::find(1);

	// echo $u->isReady();
	
	// echo md5('25'.csrf_token());
	// echo preg_match_all('/[^а-я\.]/u', 'привет');
	// echo C
	// print_r( new \DateTime('2015-02-02 00:59:21'));

	// echo Post::whereId('1')->select('header', 'id')->first();

	// echo User::whereId(Auth::id())->select('id', 'name')->first();

	// echo Mail::send('emails.verify', ['code' => 'fuck'], function($message) {
	// 		$message
	// 			// ->from('info@patriotki.ru', 'МЖА | Блоги')
	// 			->to('vlad.flip.prg@gmail.com', 'Подтверждение email')
	// 			->subject('МЖА - вы не робот');
	// 	});
	// echo 'fuck';
	// mail('vlad.flip.prg@gmail.com', 'asdf', 'asdf');

	// $p = Post::find(2);
	// $im = new PostImage(['src' => 'blabla']);

	// echo $p;
	// $im->post()->associate($p);
	// $im->save();

});

// Event::listen('illuminate.query', function($query)
// {
//     var_dump($query);
// });

Route::post('/add-post', ['before' => 'csrf', 'as' => 'add_post', 'uses' => 'PostController@create']);

Route::get('/пост{id}',['as' => 'post', 'uses' => 'PostController@get_post'])
	->where('id','[0-9]+');


Route::post('/load-more-posts', ['as' => 'load_more_posts', 'uses' => 'PostController@load_more']);
Route::post('/load-more-posts-main', ['as' => 'load_more_posts_main', 'uses' => 'PostController@load_more_main']);


// ********************************************* COMMENTS

// Route::post('/add-comment', ['before' => 'csrf', 'as' => 'add_comment', 'uses' => 'CommentController@create']);

Route::post('/load-more-comments', ['as' => 'load_more_comments', 'uses' => 'CommentController@load_more']);

// ********************************************* MESSAGES

Route::get('/сообщения', ['as' => 'messages', 'uses' => 'MessageController@index']);
Route::post('/send-message', ['before' => 'csrf', 'as' => 'send_message', 'uses' => 'MessageController@send']);


// Route::get('/{login}', ['as' => 'profile', 'uses' => 'UserController@profile'])
// ->where('login', '[^-]+');

Event::listen('auth.login', function($user){

	$user->last_logged_in = new Carbon();

	$user->new_logged_in = new Carbon();

	$user->save();

});

// ------------------------------------------------ ADMIN

Route::group(['before' => 'admin.auth'], function(){

	Route::get('/админ', function(){
		return Redirect::to('/админ/посты');
	});

	Route::get('/админ/посты', ['uses' => 'AdminController@posts', 'as' => 'admin.posts']);

	Route::get('/админ/юзеры', ['uses' => 'AdminController@users', 'as' => 'admin.users']);

	Route::group(['before' => 'csrf'], function(){

		Route::post('/admin-delete-post', 'AdminController@deletePost');

		Route::post('/admin-ban-user', 'AdminController@banUser');

	});
});

App::missing(function($exception)
{
    return Response::view('errors.404');
});