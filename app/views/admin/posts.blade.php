@extends('admin.admin')

@section('table')

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
			<th></th>
			<th></th>
		</tr>
	</thead>

	@foreach($posts as $key => $val)

		<tr class="{{ $val->attached ? 'light' : '' }}">
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
				<span onclick="admin.attach({{ $val->id }}, this)">
					{{ $val->attached ? 'Убрать из топа' : 'В топ' }}
				</span>
			</td>

			<td>
				<span onclick="admin.deletePost({{ $val->id }}, this)">Удалить</span>
			</td>
		</tr>

	@endforeach
</table>

@stop