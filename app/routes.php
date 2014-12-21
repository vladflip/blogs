<?php


// ******************************************* USERs
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);

// Route::get('/ex', function(){
// 	print_r(Session::all());
// });

Route::post('/forget', ['as' => 'forget', 'before' => 'csrf', 'uses' => 'UserController@forget']);

Route::get('/id{id}',['as' => 'reg_profile', 'uses' => 'UserController@reg_profile'])
	->where('id','[0-9]+');

Route::post('/login', ['as' => 'login', 'uses' => 'UserController@login']);

Route::post('/register', ['as' => 'register', 'uses' => 'UserController@register']);

Route::get('/ajax-check-email', function(){
echo 'good';
});

Route::post('/ajax-check-email', array('as'=>'ajax_check_email', 'uses' => 'UserController@ajax_check_email'));

Route::post('/edit-ava' , ['as' => 'edit_ava', 'uses' => 'UserController@edit_ava']);

Route::post('/delete-ava', 'UserController@delete_temp_ava');

Route::post('/submit-ava', ['as' => 'submit_ava', 'uses' => 'UserController@submit_ava']);

// Route::get('/exe', function(){
// 	$path = 'img/' . 'id' . Auth::id() . '/';
// 	if (!file_exists($path) && !is_dir($path)) {
// 			$t = mkdir($path,0777,true);
// 		}
// });

Route::get('/check-for-allow-posting', ['as' => 'check_for_allow', 'uses' => 'UserController@check_for_allow']);
Route::post('/edit-profile', ['as' => 'edit_profile', 'uses' => 'UserController@edit_profile']);
Route::post('/edit-login', ['as' => 'edit_login', 'uses' => 'UserController@edit_login']);
Route::post('/submit-login', ['before' => 'csrf','as' => 'submit_login', 'uses' => 'UserController@submit_login']);



// *********************************************** POSTs

Route::post('/creat-post', ['as' => 'create_post', 'uses' => 'PostController@create']);

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
	echo preg_match_all('/[^а-я\.]/u', 'привет');
});

// Event::listen('illuminate.query', function($query)
// {
//     var_dump($query);
// });

Route::post('/add-post', ['before' => 'csrf', 'as' => 'add_post', 'uses' => 'PostController@create']);

Route::get('/post{id}',['as' => 'post', 'uses' => 'PostController@get_post'])
	->where('id','[0-9]+');

Route::get('/like-post', ['as' => 'like_post', 'uses' => 'PostController@like']);
Route::get('/dislike-post', ['as' => 'dislike_post', 'uses' => 'PostController@dislike']);

Route::post('/load-more-posts', ['as' => 'load_more_posts', 'uses' => 'PostController@load_more']);


// *********************************************COMMENTS

Route::post('/add-comment', ['as' => 'add_comment', 'uses' => 'CommentController@create']);

Route::get('/like-comment', ['as' => 'like_comment', 'uses' => 'CommentController@like']);
Route::get('/dislike-comment', ['as' => 'dislike_comment', 'uses' => 'CommentController@dislike']);
Route::post('/create-wall-comment', ['as' => 'create_wall_comment', 'uses' => 'CommentController@create_wall_comment']);

Route::get('/{login}', ['as' => 'profile', 'uses' => 'UserController@profile'])
->where('login', '[^-]+');
