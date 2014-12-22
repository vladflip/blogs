<div class="add-post">
	
	<div class="a-p_cap">
		<div class="a-p_plus">
			<img src="img/add-post_plus.png" alt="">
			<div>Добавить новость</div>
		</div>
	</div>

	{{ Form::open(['route' => 'add_post', 'method' => 'post', 'class' => 'a-p_form', 
		'id' => 'a_pForm', 'enctype' => 'application/x-www-form-urlencoded']) }}
		{{ Form::text('header', null, ['class' => 'a-p-header']) }}
		{{ Form::textArea('content', null, ['class' => 'a-p-content']) }}
		{{ Form::submit('Отправить!', ['class' => 'a-p-btn', 'id' => 'submitNewPost']) }}
	{{ Form::close() }}
</div>