@extends('layouts.main')

@section('header')
	@parent
	<script src="{{ URL::asset('js/jquery.js') }}"></script>
@stop

@section('body')
	
	<table>

		<tr>
			<td>
				Юзер
			</td>
			<td>
				Посты
			</td>
			<td>
				Комменты
			</td>
		</tr>

		@foreach($users as $key => $val)
	
			<tr>
				<td>
					<a href="{{ route('profile', $val->id) }}">{{ $val->name }}</a>
				</td>

				<td>
					{{ $val->posts->count() }}
				</td>

				<td>
					{{ $val->comments->count() }}
				</td>
			</tr>

		@endforeach
	</table>

@stop