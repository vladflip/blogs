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
		{{ Form::text('header', null, ['class' => 'add-post-header']) }}
		{{ Form::textArea('content', null, ['class' => 'add-post-content', 'rows' => '5']) }}
		{{ Form::submit('Отправить!', ['class' => 'add-post-btn']) }}
	{{ Form::close() }}
</div>
@else
	<span>Вы не можете писать посты</span>
@endif