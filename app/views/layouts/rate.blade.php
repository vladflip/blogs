<table class="rate-table">
	@foreach($u_rate as $k => $v)
		<tr>
			<td class="r-t_ava">
				<img src="{{ $v->ava_sm }}" alt="">
			</td>

			<td class="r-t_name">
				<span>{{ $v->name }}</span>
			</td>

			<td class="r-t_rate">
				<span>{{ $v->rate }}</span>
			</td>
		</tr>
	@endforeach
</table>