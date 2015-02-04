@extends('layouts.main')

@section('header')
	@parent
	<script src="{{ URL::asset('js/jquery.js') }}"></script>
@stop

@section('body')
	
	<table>

		<tr>
			<td>
				Заголовок
			</td>
			<td>
				Комменты
			</td>
			<td>
				Лайки
			</td>
			<td>
				Юзер
			</td>
		</tr>

		@foreach($posts as $key => $val)
	
			<tr>
				<td>
					<a href="{{ route('post', $val->id) }}" target="_blank">{{ $val->header }}</a>
				</td>

				<td>
					{{ $val->comments->count() }}
				</td>

				<td>
					{{ $val->likes->count() }}
				</td>

				<td>
					{{ $val->user->name }}
				</td>

				<td>
					Удалить
				</td>
			</tr>

		@endforeach
	</table>

@stop