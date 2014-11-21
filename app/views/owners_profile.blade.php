@extends('layouts.profile')

@section('ava_xl')
	@if(empty($user->ava_xl))
		<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">
	@else
		<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
	@endif
@stop

@section('login')
	{{ $user->login or 'логин' }}
@stop