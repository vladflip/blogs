<hr>
<div class="w-p_c_ava">
	<img src="{{ $user->ava_sm }}" alt="">
</div>
<div class="w-p_c-c">
	<div class="w-p_c_header">
		{{ $user->name }}
	</div>
	<div class="w-p_c_date">
		{{ $comment->created_at->day.'.'.$comment->created_at->month.'.'.$comment->created_at->year }}
	</div>
	<div class="w-p_c_content">
		{{ $comment->content }}
	</div>
</div>

<div class="w-p_c_like" 
onclick="like_comment('{{ md5($comment->id.$comment->id) }}', {{ $comment->id }}, this)">
	@if($comment->likes->contains(Auth::id()))
		<img src="img/liked.png" alt="" onclick="return false;">
	@else
		<img src="img/not_liked.png" alt="" onclick="return false;">
	@endif
	<span class="cnt_likes">{{ count($comment->likes) }}</span>
</div>
<div class="clear-fix"></div>