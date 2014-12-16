<h4 class="p_w_header">
	Новости
</h4>

<br>

@if(count($user->posts)>0)

<div class="w_posts">
	@include('layouts.posts.wall_posts')
</div>

@if(count($user->posts)===5)

<div class="loadmore_post">
	<input type="hidden" value="{{ $user->id }}">
	Загрузить еще
</div>

@endif

@endif