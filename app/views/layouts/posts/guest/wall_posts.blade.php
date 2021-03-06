@if(count($user->posts)===0)

	{{ 'no posts' }}

@else

	@foreach($user->posts as $k => $v)
		
		<div class="w-post">
			
			@include('layouts.posts.post')

			<div class="w-p_like disabled">
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
					@include('layouts.posts.guest.wall_comments')
				</div>

			{{-- add comment --}}
			{{-- ----------------------------------------------- --}}
		</div>

	@endforeach
	
	@include('layouts.posts.grid')

@endif