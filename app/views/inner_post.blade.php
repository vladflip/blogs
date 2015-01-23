@extends('layouts.main')

@section('body')

	<div class="w-post">

		<div class="w-p_user-block">

		<div class="w-p_user-ava">
			<a href="{{ $post->user->url() }}">
				<img src="{{ $post->user->ava_sm }}" alt="">
			</a>
		</div>

		<div class="w-p_user-name">
			<a href="{{ $post->user->url() }}">
				{{ $post->user->name }}
			</a>
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

		<div class="w-p_like" 
		onclick="like_post('{{ md5($post->id.$post->id) }}', {{ $post->id }}, this)">

			@if($post->likes->contains(Auth::id()))
				<img src="img/liked.png" alt="" onclick="return false;">
			@else
				<img src="img/not_liked.png" alt="" onclick="return false;">
			@endif
			<span class="cnt_likes">{{ count($post->likes) }}</span>

		</div>

		{{-- ----------------------------------------------- --}}
		{{-- add comment --}}

			@set('v', $post);
			<div class="w-p_comments-block">
				@include('layouts.posts.wall_comments')
			</div>

		{{-- add comment --}}
		{{-- ----------------------------------------------- --}}
	</div>
@stop

@section('footer')
	@parent
	<script src="js/jquery.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/wall.js"></script>
@stop