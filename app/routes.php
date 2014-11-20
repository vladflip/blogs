<?php

Route::get('/id{id}',['as' => 'profile', 'uses' => 'UserController@profile'])
	->where('id','[0-9]+');

Route::post('/login', ['as' => 'login', 'uses' => 'UserController@login']);

Route::post('/register', ['as' => 'register', 'uses' => 'UserController@register']);

Route::get('/', ['as' => 'home', function(){
	return View::make('home');
}]);

Route::get('/ajax-check-email', function(){
echo 'good';
});

Route::post('/ajax-check-email', array('as'=>'ajax_check_email', 'uses' => 'UserController@ajax_check_email'));

Route::post('/edit-ava' , ['as' => 'edit_ava', 'uses' => 'UserController@edit_ava']);

Route::post('/delete-ava', 'UserController@delete_temp_ava');

Route::post('/submit-ava', ['as' => 'submit_ava', 'uses' => 'UserController@submit_ava']);

Route::get('/exe', function(){
	$path = 'img/' . 'id' . Auth::id() . '/';
	if (!file_exists($path) && !is_dir($path)) {
			$t = mkdir($path,0777,true);
		}
});

Route::get('edit-profile', ['as' => 'edit_profile', 'uses' => 'UserController@edit_profile']);