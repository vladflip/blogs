<?php

Route::get('/id{id}',['as' => 'profile', 'uses' => 'UserController@profile'])
	->where('id','[1-9]+');

Route::post('/login', ['as' => 'login', 'uses' => 'UserController@login']);

Route::post('/register', ['as' => 'register', 'uses' => 'UserController@register']);

Route::get('/', ['as' => 'home', function(){
	return View::make('home');
}]);

Route::post('/ajax-check-email', array('as'=>'ajax_check_email', 'uses' => 'UserController@ajax_check_email'));

Route::post('/edit' ,['as' => 'edit_me', 'uses' => 'UserController@edit_me']);

Route::get('/fuck', function(){
	$img = Image::make('img/ex.jpg')->crop(382, 382, 205, 63)->save('img/fuck.jpg');
});