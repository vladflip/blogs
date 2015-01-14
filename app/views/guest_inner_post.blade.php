@extends('layouts.main')

@section('body')
	<div class="w-post">

		<div class="w-p_user-block">

		<div class="w-p_user-ava">
			<img src="{{ $post->user->ava_sm }}" alt="">
		</div>

		<div class="w-p_user-name">
			{{ $post->user->name }}
		</div>

		</div>

		<div class="w-p_date">
			{{ $post->created_at->day.'.'.$post->created_at->month.'.'.$post->created_at->year }}
		</div>

		<div class="w-p_header">
			{{ $post->header }}
		</div>

		<div class="w-p_content">
			@if(preg_match_all('/<br><br>/', $post->content)>5)
				<?php
					preg_match_all('/<br><br>/', $post->content, $matches, PREG_OFFSET_CAPTURE);

					$span1 = substr($post->content, 0, $matches[0][5][1]);

					$span2 = substr($post->content, $matches[0][5][1]);

				?>
				<span class="s1">
					{{ $span1 }}
				</span>
				<div class="readmore_post" onclick="readmore_post(this)">Читать далее...</div>
				<span class="s2" style="display:none">
					{{ $span2 }}
				</span>
			@elseif(strlen($post->content)>400)
				<?php
					$span1 = substr($post->content, 0, 400);

					$span2 = substr($post->content, 400);
				?>
				<span class="s1">
					{{ $span1 }}
				</span>
				<div class="readmore_post" onclick="readmore_post(this)">Читать далее...</div>
				<span class="s2" style="display:none">
					{{ $span2 }}
				</span>
			@else
				{{ $post->content }}
			@endif
		</div>

		<div class="w-p_images"></div>

		<div class="w-p_like disabled">

			<img src="img/not_liked.png" alt="" onclick="return false;">

			<span class="cnt_likes">{{ count($post->likes) }}</span>

		</div>

		{{-- ----------------------------------------------- --}}
		{{-- add comment --}}

			@set('v', $post);
			<div class="w-p_comments-block">
				@include('layouts.posts.guest.wall_comments')
			</div>

		{{-- add comment --}}
		{{-- ----------------------------------------------- --}}
	</div>
@stop

@section('footer')
	@parent
	<script>
		function load_more_comments(el){
			el.parentNode.getElementsByClassName('load-more-comments-block')[0].style.display = 'block';
			el.style.display = 'none';
		}

		function readmore_post(el){
			el.style.display = 'none';
			el.parentNode.getElementsByClassName('s2')[0].style.display = '';
		}
	</script>
@stop