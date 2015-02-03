@extends('layouts.main')

@section('body')

	<div class="write-msg-block" id="writeMsg">
		{{ Form::open(['route' => 'send_message', 'class' => 'write-msg-from']) }}
			{{ Form::textArea('message', null, ['autocomplete' => 'off', 'class' => 'send-message-input']) }}
			<input class="hidden" type="hidden" name="receiver">
			{{ Form::submit() }}
		{{ Form::close() }}
	</div>

	<div class="message-block">
		<div class="m-b_panes">
			<div class="m-b_p-in m-b_p-choisen">Принятые</div>
			<div class="m-b_p-out m-b_p-disabled">Отправленные</div>
		</div>
		<div class="clear-fix"></div>
	

		@if($in)
			
			<table class="m-b_received-table">

				@foreach($in as $k => $v)
						
					<tr class="message-raw">
						<td class="ms_ava">
							<a href="{{ route('profile', $v->sender->id) }}">
								<img src="{{ $v->sender->ava_sm }}" alt="">
							</a>
						</td>
						<td class="ms_name">
							<a href="{{ route('profile', $v->sender->id) }}">
								{{ $v->sender->name }}
							</a>
						</td>
						<td class="ms_msg">
							{{ $v->msg }}
						</td>
						<td class="ms_reply" data-id="{{ $v->sender->id }}">
							Ответить
						</td>
					</tr>
						
				@endforeach

			</table>
		
		@else
			нет принятых
		@endif
		
		@if($out)
			
			<table class="m-b_sent-table">

				@foreach($out as $k => $v)
						
					<tr class="message-raw @if($v->status == 0){{ 'unread' }}@endif">
						<td class="ms_ava">
							<a href="{{ route('profile', $v->receiver->id) }}">
								<img src="{{ $v->receiver->ava_sm }}" alt="">
							</a>
						</td>
						<td class="ms_name">
							<a href="{{ route('profile', $v->receiver->id) }}">
								{{ $v->receiver->name }}
							</a>
						</td>
						<td class="ms_msg">
							{{ $v->msg }}
						</td>
					</tr>
						
				@endforeach

			</table>
		
		@else
			нет отправленных
		@endif

	</div>

@stop

@section('footer')
	@parent

	<script src="js/message.js"></script>
@stop