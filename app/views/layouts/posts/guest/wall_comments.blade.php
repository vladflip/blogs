{{-- ------------------------------------ --}}
{{-- comment block --}}

@foreach ($v->comments as $key => $val)

<div class="w-p_c-block">
<hr>
	<div class="w-p_c_ava">
		<img src="{{ $val->user->ava_sm }}" alt="">
	</div>
	<div class="w-p_c-c">
		<div class="w-p_c_header">
			{{ $val->user->name }}
		</div>
		<div class="w-p_c_date">
			{{ $val->created_at->day.'.'.$val->created_at->month.'.'.$val->created_at->year }}
		</div>
		<div class="w-p_c_content">
			{{ $val->content }}
		</div>
	</div>

	<div class="w-p_c_like disabled" onclick="like('{{ md5($val->id.$val->id) }}', {{ $val->id }}, this)">
		@if($val->likes->contains(Auth::id()))
			<img src="img/liked.png" alt="" onclick="return false;">
		@else
			<img src="img/not_liked.png" alt="" onclick="return false;">
		@endif
		<span class="cnt_likes">{{ count($val->likes) }}</span>
	</div>
	<div class="clear-fix"></div>
</div>

@endforeach

{{-- comment block --}}
{{-- ------------------------------------ --}}