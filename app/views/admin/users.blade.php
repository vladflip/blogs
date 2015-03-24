@extends('admin.admin')

@section('table')

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
				Рейтинг
			</th>
			<th>
				
			</th>
		</tr>
	</thead>

	@foreach($users as $key => $val)

		<?php if($val->id == Auth::id()) continue; ?>

		<tr class="{{ $val->banned() ? 'light' : '' }}">
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
				{{ $val->rate }}
			</td>

			<td>
				<span onclick="admin.banUser({{ $val->id }}, this)">
					{{ $val->banned ? 'Разбан' : 'Бан' }}
				</span>
			</td>
		</tr>

	@endforeach

@stop