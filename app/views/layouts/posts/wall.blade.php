<h4 class="p_w_header">
	Новости
</h4>

@if(!isset($not_ready))

<div class="add-post">
	<div class="a-p_cap">
		<div class="a-p_plus">
			<img src="img/add-post_plus.png" alt="">
			<div>Добавить новость</div>
		</div>
	</div>
	{{ Form::open(['route' => 'add_post', 'method' => 'post', 'class' => 'a-p_form', 'id' => 'a_pForm']) }}
		{{ Form::text('header', null, ['class' => 'a-p-header']) }}
		{{ Form::textArea('content', null, ['class' => 'a-p-content', 'rows' => '5']) }}
		{{ Form::submit('Отправить!', ['class' => 'a-p-btn', 'id' => 'submitNewPost']) }}
	{{ Form::close() }}
</div>

@else
	<span>Вы не можете писать посты</span>
@endif

@if(!isset($not_ready))

<div class="w_posts">
	@include('layouts.posts.wall_posts')
</div>

@endif