@extends('layouts.profile')

@section('ava_xl')
	@if(!empty($user->ava_xl)&&file_exists($user->ava_xl))
		<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
	@else
		<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">	
	@endif
@stop

@section('login')
	<span>{{{ $user->login or 'логин' }}}</span>
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
	<textarea name="" id="" cols="40" rows="4">{{ $user->about or 'о себе' }}</textarea>
@stop


@section('add-post')
	@if(!isset($not_ready))
		<div class="add-post">
			{{ Form::open(['route' => 'add_post', 'method' => 'post']) }}
				{{ Form::text('header', null, ['class' => 'add-post-header']) }}
				{{ Form::textArea('content', null, ['class' => 'add-post-content']) }}
				{{ Form::submit('Отправить!', ['class' => 'add-post-btn']) }}
			{{ Form::close() }}
		</div>
	@else
		<span>Вы не можете писать посты</span>
	@endif
@stop


@section('profile.js')
	<script src="js/jquery.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	<script src="js/jquery.autosize.input.js"></script>
	<script src="js/profile.js"></script>
@stop