<table class="rate-table">
	@foreach($u_rate as $k => $v)
		@if($v->isReady())
			<tr>
				<td class="r-t_ava">
					
					<a href="{{ $v->url() }}">
						<img src="{{ $v->ava_sm }}" alt="">
					</a>
			
				</td>

				<td class="r-t_name">

					<a href="{{ $v->url() }}">
						<span>{{ $v->name }}</span>
					</a>

				</td>

				<td class="r-t_rate">
					<span>{{ $v->rate }}</span>
				</td>
			</tr>
		@endif
	@endforeach
</table>