@extends('layouts.main')

@section('body')

	@if($msgs)
		
		@foreach($msgs as $k => $v)

			<div class="message-block">
				<div class="ms_ava">
					<img src="{{ $v->sender->ava_sm }}" alt="">
				</div>
				<div class="sender-name">
					{{ $v->sender->name }}
				</div>
				<div class="msg">
					{{ $v->msg }}
				</div>
			</div>

		@endforeach

	@else
		нет сообщений
	@endif

@stop