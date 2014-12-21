@if(count($user->posts)>0)

<h4 class="p_w_header">
	Новости
</h4>

<br>

<div class="w_posts">
	@include('layouts.posts.guest.wall_posts')
</div>

@endif

@if(count($user->posts)===5)

<div class="loadmore_post">
	<input type="hidden" value="{{ $user->id }}">
	Загрузить еще
</div>

@endif