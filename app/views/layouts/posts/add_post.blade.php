<div class="add-post">
	
	<div class="a-p_cap">
		<div class="a-p_plus">
			<img src="img/add-post_plus.png" alt="">
			<div>Добавить новость</div>
		</div>
	</div>

	{{ Form::open(['route' => 'add_post', 'method' => 'post', 'class' => 'a-p_form', 
		'id' => 'a_pForm', 'files' => 'true']) }}
		{{ Form::text('header', null, ['class' => 'a-p-header', 'placeholder' => 'Заголовок']) }}
		{{ Form::textArea('content', null, ['class' => 'a-p-content', 'placeholder' => 'Контент']) }}
		<div class="freewall" id="freewall">
			<div class="clear-fix"></div>
		</div>
		<div class="a-p_btns">
			{{ Form::submit('Отправить!', ['class' => 'a-p-btn', 'id' => 'submitNewPost']) }}
			{{ Form::file('imgs[]', ['multiple' => 'true', 'class' => 'a-p_add-photo', 'id' => 'addPhoto']) }}
			{{-- <input type="file" name="imgs" class="a-p_add-photo" id="addPhoto"> --}}
			<div class="clear-fix"></div>
		</div>
	{{ Form::close() }}
</div>