@extends('layouts.main')

@section('body')
	<div class="inner-post">
		<h1>{{ $post->header }}</h1>
		<p>{{ $post->content }}</p>
	</div>
		<hr>
	<div class="comments-block">
		<h4 class="">Комментарии ({{ count($post->comments) }})</h4>
		
		<div class="add-comment">
			<div class="c-ava" id="authAva">
				<a href="{{ route('profile', $post->user->id) }}">
					<img src="{{ $post->user->ava_sm }}" alt="">
				</a>
			</div>
			<div class="a-c_in">
				<textarea name="" id="add-com-input" cols="90" rows="2" resize="none" placeholder="Напишите комментарий"></textarea>
				<div class="submit-comment" id="submitComment" 
					onclick="submit_comment('{{ md5($post->id.csrf_token()) }}', {{ $post->id }})">
					Отправить!
				</div>
			</div>
		</div>
		<div class="comment-items" id="commentItems">
		@foreach ($post->comments as $e)
			<div class="comment">
				<div class="c-ava">
					<img src="{{ $e->toArray()['user']['ava_sm'] }}" alt=""> 
				</div>
				<div class="c_c">
					<div class="c-c_header">
						{{ $e->toArray()['user']['name']}}
					</div>
					<div class="c-c_date">
						{{ $e['created_at'] }}
					</div>
					<div class="c-c_content">
						{{ $e['content'] }}
					</div>
					<div class="m-p_likes" 
					onclick="like('{{ md5($e->id.$e->id) }}', {{ $e->id }}, this)">
			
						@if($e->likes->contains(Auth::id()))
							<img src="img/liked.png" alt="" onclick="return false;">
						@else
							<img src="img/not_liked.png" alt="" onclick="return false;">
						@endif
			
						<span class="cnt_likes">{{ count($e->likes) }}</span>
					</div>
				</div>
			<hr>
			</div>
		@endforeach
		</div>
	</div>
@stop

@section('footer')
	@parent
	<script src="js/jquery.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/inner_post.js"></script>
@stop