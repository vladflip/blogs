<div class="c-ava">
	<img src="{{ $user->ava_sm }}" alt=""> 
</div>
<div class="c_c">
	<div class="c-c_header">
		{{ $user->name }}
	</div>
	<div class="c-c_date">
		{{ $cmt->created_at }}
	</div>
	<div class="c-c_content">
		{{ $cmt->content }}
	</div>
	<div class="m-p_likes" onclick="like('{{ md5($cmt->id.$cmt->id) }}', {{ $cmt->id }}, this)">
		<img src="img/not_liked.png" alt="" onclick="return false;">
		<span class="cnt_likes">0</span>
	</div>
</div>
<hr>