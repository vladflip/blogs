@extends('layouts.main')

@section('body')
	<div class="inner-post">
		<h1>{{ $post->header }}</h1>
		<p>{{ $post->content }}</p>
	</div>
		<hr>
	<div class="comments-block">
		<h4 class="">Комментарии ({{ count($post->comments) }})</h4>
		
		@if(isset($auth))
			<div class="add-comment">
				<div class="restriction-comment">
					Вы не можете комментировать
				</div>
			</div>
		@endif

		<div class="comment-items guest-post" id="commentItems">
		@foreach ($post->comments as $e)
			<div class="comment">
				<div class="c-ava">
					<img src="{{ $e->toArray()['user']['ava_sm'] }}" alt=""> 
				</div>
				<div class="c_c">
					<div class="c-c_header">
						{{ $e->toArray()['user']['firstname'].' '.$e->toArray()['user']['lastname'] }}
					</div>
					<div class="c-c_date">
						{{ $e['created_at'] }}
					</div>
					<div class="c-c_content">
						{{ $e['content'] }}
					</div>
					<div class="m-p_likes">
			
						<img src="img/not_liked.png" alt="" onclick="return false;">
						<span class="cnt_likes">{{ count($e->likes) }}</span>

					</div>
				</div>
			<hr>
			</div>
		@endforeach
		</div>
	</div>
@stop
