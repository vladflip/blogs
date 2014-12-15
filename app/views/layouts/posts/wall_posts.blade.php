@foreach($user->posts as $k => $v)
	
	<div class="w-post">

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
			{{ $v->content }}
		</div>
		
		<div class="w-p_images"></div>

		<div class="w-p_like">
			@if($v->likes->contains(Auth::id()))
				<img src="img/liked.png" alt="" onclick="return false;">
			@else
				<img src="img/not_liked.png" alt="" onclick="return false;">
			@endif
			<span class="cnt_likes">{{ count($v->likes) }}</span>
		</div>

		{{-- ----------------------------------------------- --}}
		{{-- add comment --}}

			<div class="w-p_comments-block">
				@include('layouts.posts.wall_comments')
			</div>

		{{-- add comment --}}
		{{-- ----------------------------------------------- --}}
	</div>

@endforeach