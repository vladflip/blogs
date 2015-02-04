<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	if (Auth::user()) {
		$user = Auth::user();
		$now = Carbon::now();
		$user->last_logged_in = $user->new_logged_in->toDateTimeString();
		$user->new_logged_in = $now;
		$user->save();
	}

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});

Route::filter('admin.auth', function(){

	if(Auth::guest() || ! Auth::user()->isAdmin())
		return 'вы не админ идите в попку';

});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	$token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
	if (Session::token() != $token)
		throw new Illuminate\Session\TokenMismatchException;
});

/**
 * -------------------------------------------------------------------------
 * Login name Filter
 * -------------------------------------------------------------------------
 */

// Route::filter('login', function($route){
// 	$login = $route->getParameter('login');
// 	if(!User::whereLogin($login)->pluck('login')){
// 		App::abort('404');
// 	}
// });


/*
* -------------------------------------
* 	Profile for not authorized users
* -------------------------------------
* 	Owners Profile
* -------------------------------------
* 	Guest Authorization profile
* -------------------------------------
*/
View::composer(['guest_profile', 
				'owners_profile', 
				'layouts.guest_auth_profile'], 
	function($v){
		$data = $v->getData();

		$v->with('user', User::with(['posts' => function($q){

			$q->with('likes')

			->with(['comments' => function($q2){
				$q2->with('likes')
					->with('user')
					->orderBy('id', 'DESC');
			}])

			->orderBy('id', 'DESC')
			->take(5);

		}])->find($data['id']));
	});