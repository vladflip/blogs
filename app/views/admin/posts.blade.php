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
					Заголовок
				</th>
				<th>
					Комменты
				</th>
				<th>
					Лайки
				</th>
				<th>
					Содержание
				</th>
				<th>
					Юзер
				</th>
				<th></th>
			</tr>
		</thead>

		@foreach($posts as $key => $val)
	
			<tr>
				<td>
					<a href="{{ route('post', $val->id) }}" target="_blank">
						{{ $val->header }}
					</a>
				</td>

				<td>
					{{ $val->comments->count() }}
				</td>

				<td>
					{{ $val->likes->count() }}
				</td>

				<td>
					{{ $val->content }}
				</td>

				<td>
					<a href="{{ route('profile',$val->user->id) }}">{{ $val->user->name }}</a>
				</td>
				<td>
					<span onclick="admin.deletePost({{ $val->id }}, this)">Удалить</span>
				</td>
			</tr>

		@endforeach
	</table>

@stop

@section('footer')
	@parent
	<script src="{{ URL::to('/') }}/js/admin.js"></script>
@stop