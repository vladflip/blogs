<div class="w-p_c_edit-delete">
	<div class="w-p_c_e-d_delete" 
		onclick="delete_comment('{{ md5($comment->id.$comment->user->id) }}', {{ $comment->id }}, this)">
	</div>
</div>

<hr>
<div class="w-p_c_ava">
	<a href="{{ $comment->user->url() }}">
		<img src="{{ $comment->user->ava_sm }}" alt="">
	</a>
</div>
<div class="w-p_c-c">
	<div class="w-p_c_header">
		<a href="{{ $comment->user->url() }}">
			{{ $comment->user->name }}
		</a>
	</div>
	<div class="w-p_c_content">
		{{ $comment->content }}
	</div>
</div>


<div class="w-p_date-like">
	<div class="w-p_c_date">
		{{ $comment->created_at->day.'.'.$comment->created_at->month.'.'.$comment->created_at->year }}
	</div>
	<div class="w-p_c_like" 
	onclick="like_comment('{{ md5($comment->id.$comment->id) }}', {{ $comment->id }}, this)">

			<img src="img/not_liked.png" alt="" onclick="return false;">

		<span class="cnt_likes">0</span>
	</div>
</div>


<div class="clear-fix"></div>