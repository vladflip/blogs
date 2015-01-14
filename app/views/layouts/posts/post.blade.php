<div class="w-p_user-block">

	<div class="w-p_user-ava">
		<img src="{{ $user->ava_sm }}" alt="">
	</div>

	<div class="w-p_user-name">
		{{ $user->name }}
	</div>

</div>

<div class="w-p_date">
	{{ $v->created_at->day.'.'.$v->created_at->month.'.'.$v->created_at->year }}
</div>

<div class="w-p_header">
	{{ $v->header }}
</div>

<div class="w-p_content">
	@if(preg_match_all('/<br><br>/', $v->content)>5)
		<?php
			preg_match_all('/<br><br>/', $v->content, $matches, PREG_OFFSET_CAPTURE);

			$span1 = substr($v->content, 0, $matches[0][5][1]);

			$span2 = substr($v->content, $matches[0][5][1]);

		?>
		<span class="s1">
			{{ $span1 }}
		</span>
		<div class="readmore_post" onclick="readmore_post(this)">Читать далее...</div>
		<span class="s2" style="display:none">
			{{ $span2 }}
		</span>
	@elseif(strlen($v->content)>400)
		<?php
			$span1 = substr($v->content, 0, 400);

			$span2 = substr($v->content, 400);
		?>
		<span class="s1">
			{{ $span1 }}
		</span>
		<div class="readmore_post" onclick="readmore_post(this)">Читать далее...</div>
		<span class="s2" style="display:none">
			{{ $span2 }}
		</span>
	@else
		{{ $v->content }}
	@endif
</div>

<div class="w-p_images"></div>