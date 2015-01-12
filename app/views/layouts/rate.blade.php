<table class="rate-table">
	@foreach($u_rate as $k => $v)
		<tr>
			<td class="r-t_ava">
				<a href="{{ route('profile', $v->login) }}">
					<img src="{{ $v->ava_sm }}" alt="">
				</a>
			</td>

			<td class="r-t_name">
				<a href="{{ route('profile', $v->login) }}">
					<span>{{ $v->name }}</span>
				</a>
			</td>

			<td class="r-t_rate">
				<span>{{ $v->rate }}</span>
			</td>
		</tr>
	@endforeach
</table>