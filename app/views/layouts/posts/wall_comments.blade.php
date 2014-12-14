{{-- ------------------------------------ --}}
{{-- add form --}}

<div class="w-p_add-comment">
	<div class="w-p_a-c_in">
		<textarea name="" class="w-p_a-c-input" placeholder="Напишите комментарий"></textarea>
		<div class="submit-comment">
			Отправить
		</div>
	</div>
</div>

{{-- add form --}}
{{-- ------------------------------------ --}}


{{-- ------------------------------------ --}}
{{-- comment block --}}

@foreach ($v->comments as $key => $val)

<div class="w-p_c-block">
<hr>
	<div class="w-p_c_ava">
		<img src="{{ $user->ava_sm }}" alt="">
	</div>
	<div class="w-p_c-c">
		<div class="w-p_c_header">
			{{ var_dump($val) }}
		</div>
		<div class="w-p_c_date">
			{{ $val->created_at->day.'.'.$val->created_at->month.'.'.$val->created_at->year }}
		</div>
		<div class="w-p_c_content">
			{{ $val->content }}
		</div>
	</div>

	<div class="w-p_c_like">
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