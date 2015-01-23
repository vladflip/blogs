@extends('layouts.profile')

@section('ava_xl')
	@if(!empty($user->ava_xl)&&file_exists($user->ava_xl))
		<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
	@else
		<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">	
	@endif
@stop

@section('rate')
	<span>{{ $user->rate or 0 }}</span>
@stop

@section('login')

	<input type="text" value="{{ $user->login or 'логин' }}">
	{{-- <span>{{{ $user->login or 'логин' }}}</span> --}}
@stop

@section('name')
	<input type="text" value="{{ $user->name or 'имя' }}">
@stop

@section('age')
	<input type="text" value="{{ $user->age or '0' }}">
@stop

@section('town')<input type="text" value="{{$user->town or 'город'}}">
@stop

@section('about')
	<textarea name="" id="" cols="40" rows="4">{{ $user->about}}</textarea>
@stop

@section('cap')
	@if($user->about)
		<div class="p_about-cap ready">
			{{ $user->about}}
		</div>
	@else
		<div class="p_about-cap">
			{{ 'Напишите о себе' }}
		</div>
	@endif
@stop

@section('profile.js')
	<script src="js/jquery.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	<script src="js/jquery.autosize.input.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/profile.js"></script>

	@if(!isset($not_ready))
		<script src="js/add_post.js"></script>
	@endif
	
	<script src="js/wall.js"></script>
@stop