@extends('layouts.main')

@section('head')
	@parent
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-nr-min.css">
	<script src="{{ URL::asset('js/jquery.js') }}"></script>
@stop

@section('body')
	
	@include('admin.header')

	<table class="pure-table pure-table-bordered pure-table-striped admin-table">

		<thead>
			<tr>
				<th>
					Юзер
				</th>
				<th>
					Посты
				</th>
				<th>
					Комменты
				</th>
				<th>
					
				</th>
			</tr>
		</thead>

		@foreach($users as $key => $val)
	
			<tr class="{{ $val->banned() ? 'banned' : '' }}">
				<td>
					<a href="{{ route('profile', $val->id) }}" target="_blank">{{ $val->name }}</a>
				</td>

				<td>
					{{ $val->posts->count() }}
				</td>

				<td>
					{{ $val->comments->count() }}
				</td>
				<td>
					<span onclick="admin.banUser({{ $val->id }}, this)">
						{{ $val->banned ? 'Разбан' : 'Бан' }}
					</span>
				</td>
			</tr>

		@endforeach
	</table>

@stop

@section('footer')
	@parent
	<script src="{{ URL::to('/') }}/js/admin.js"></script>
@stop