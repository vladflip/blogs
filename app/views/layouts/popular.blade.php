<table class="popular-table">
	@for($i=0;$i<5;$i++)
		<tr>
			<td class="p-t_head">
				<span>{{ $popular[$i]['header'] }}</span>
			</td>

			<td class="p-t_count">
				<span>{{ $popular[$i]['cnt'] }}</span>
				<img src="img/not_liked.png" alt="">
			</td>
		</tr>
	@endfor
</table>