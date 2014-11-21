@extends('layouts.profile')

@section('ava_xl')
	@if(empty($user->ava_xl))
		<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">
	@else
		<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
	@endif
@stop

@section('login')
	<span>{{ $user->login or 'логин' }}</span>
@stop

@section('fname')
	<span>{{ $user->firstname or 'имя' }}</span>
@stop

@section('lname')
	<span>{{ $user->lastname or 'фамилия' }}</span>
@stop

@section('age')
	<span>{{ $user->age or '0' }}</span>
@stop

@section('town')
	<span>{{ $user->town or 'город' }}</span>
@stop

@section('about')
	<textarea name="" id="" disabled cols="40" rows="5">{{ $user->about or 'о себе' }}</textarea>
@stop