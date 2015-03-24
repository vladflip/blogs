<table class="top-table">
	
	@foreach($top as $k => $v)
		
		<tr>
			<td class="top_head">
				<a href="{{ route('post', $v['id']) }}">
					<span>{{ $v['header'] }}</span>
				</a>
			</td>
		</tr>
		
	@endforeach
</table>