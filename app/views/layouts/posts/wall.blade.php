@if( ! $user->confirmed)

	Докажите что вы <a href="http://{{ $user->email_provider() }}">не робот</a> :)

@elseif(!isset($not_ready))
	@include('layouts.posts.add_post')
@else
	<span>Вы не можете писать посты пока не заполните профиль</span>
@endif


@if(!isset($not_ready))

<h4 class="p_w_header">
	Новости
</h4>

<div class="w_posts">
	@include('layouts.posts.wall_posts')
</div>

@endif


@if(count($user->posts)===5)

<div class="loadmore_post">
	<input type="hidden" value="{{ $user->id }}">
	Загрузить еще
</div>

@endif