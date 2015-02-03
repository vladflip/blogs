@extends('layouts/main')

@section('body')
	{{ Form::open(['route' => 'change_settings', 'method' => 'post']) }}
		
		{{ Form::label('notify_msg', 'Оповещать о сообщениях?') }}
		
		@if($notify_msg)
			{{ Form::checkbox('notify_msg', 'notify_msg', ['checked' => 'checked']) }}
		@else
			{{ Form::checkbox('notify_msg', 'notify_msg') }}
		@endif

		<br>

		{{ Form::label('notify_cmt', 'Оповещать о комментариях?') }}

		@if($notify_cmt)
			{{ Form::checkbox('notify_cmt', 'notify_cmt', ['checked' => 'checked']) }}
		@else
			{{ Form::checkbox('notify_cmt', 'notify_cmt') }}
		@endif
	
		<br>

		{{ Form::submit('Принять настройки') }}

	{{ Form::close() }}
@stop