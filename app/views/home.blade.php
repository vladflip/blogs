@extends('layouts.main')

@section('body')
	<div class="btns">
		<div class="sign-up" id="logOut">Выйти</div>
	</div>
	{{ Form::open(['action' => 'UserController@forget', 'method' => 'post', 'id' => 'logOutForm']) }}
		
	{{ Form::close() }}

	<ul class="main-posts">
		@include('layouts.posts.main_posts')
	</ul>
@stop

@section('footer')
	<script src="js/main_post.js"></script>
@stop
