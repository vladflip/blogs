<table class="popular-table">
	<?php
		$i=0;
	?>
	@foreach($popular as $k => $v)
		@if($i<5)
			<tr>
				<td class="p-t_head">
					<a href="{{ route('post', $v['id']) }}">
						<span>{{ $v['header'] }}</span>
					</a>
				</td>

				<td class="p-t_count">
					<span>{{ $v['cnt'] }}</span>
					<img src="img/not_liked.png" alt="">
				</td>
			</tr>
		@endif
	<?php
		$i++;
	?>
	@endforeach
</table>