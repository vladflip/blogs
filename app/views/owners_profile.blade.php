@extends('layouts.profile')

@section('ava_xl')
	@if(!empty($user->ava_xl)&&file_exists($user->ava_xl))
		<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
	@else
		<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">	
	@endif
@stop

@section('login')
	<input type="text" placeholder="{{ $user->login or 'логин' }}">
@stop

@section('fname')
	<input type="text" placeholder="{{ $user->firstname or 'имя' }}">
@stop

@section('lname')
	<input type="text" placeholder="{{ $user->lastname or 'фамилия' }}">
@stop

@section('age')
	<input type="text" placeholder="{{ $user->age or '0' }}">
@stop

@section('town')<input type="text" placeholder="{{$user->town or 'город'}}">
@stop

@section('about')
	<textarea name="" id="" cols="40" rows="5">{{ $user->about or 'о себе' }}</textarea>
@stop


@section('add-post')
<div class="add-post">
	{{ Form::open(['route' => 'add_post', 'method' => 'post']) }}
		{{ Form::text('header', null, ['class' => 'add-post-header']) }}
		{{ Form::textArea('content', null, ['class' => 'add-post-content']) }}
		{{ Form::submit('Отправить!', ['class' => 'add-post-btn']) }}
	{{ Form::close() }}
</div>
@stop


@section('profile.js')
	<script src="js/jquery.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	<script src="js/profile.js"></script>
@stop