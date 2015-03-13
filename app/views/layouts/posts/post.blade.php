@if(Auth::check() && Auth::id()==$user->id)
	<div class="w-p_edit-delete">
		<div class="w-p_e-d_delete" 
			onclick="delete_post('{{ md5($v->id.Auth::id()) }}', {{ $v->id }}, this)"></div>
	</div>
@endif

<div class="w-p_user-block">

	<div class="w-p_user-ava">
		<a href="{{ $user->url() }}">
			<img src="{{ $user->ava_sm }}" alt="">
		</a>
		@if($user->online())
			<div class="online">онлайн</div>
		@endif
	</div>

	<div class="w-p_user-name">
		<a href="{{ $user->url() }}">
			{{ $user->name }}
		</a>
	</div>

</div>

<div class="w-p_date">
	{{ $v->created_at->day.'.'.$v->created_at->month.'.'.$v->created_at->year }}
</div>

<div class="w-p_header">
	<a href="{{ route('post', $v->id) }}">
		{{ $v->header }}
	</a>
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

<?php
	$opts = array(
			['1'],
			['2'],
			['21','12'],
			['22', '13', '31'],
			['23', '32', '14', '41'],
			['33', '42', '51', '15', '24'],
			['25', '34', '52', '43'],
			['35', '53'],
			['45', '54'],
			['55']
		);
	if(count($v->images)>0){
		$c = count($v->images)-1;
		$t = count($opts[$c]);
		$r = rand(0, $t-1);
		$l = $opts[$c][$r];
	} else {
		$l = 0;
	}
?>

<div class="w-p_images uncomplete-gallery" data-layout="{{ $l }}" data-image="post{{ $v->id }}">
	@foreach($v->images as $img)

		<img src="{{ $img->src_sm }}" data-highres="{{ $img->src }}">
		
	@endforeach
</div>