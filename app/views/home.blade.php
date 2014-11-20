@extends('layouts.main')



@section('body')
	<div class="btns">
		<div class="sign-up" id="signUp">Регистрация</div>
		<div class="login" id="login">Войти</div>
	</div>
	{{ Form::open(array('route' => 'login', 'method' => 'post','class' => 'login-form')) }}

	{{ Form::text('login', null, ['placeholder' => 'Логин']) }}
	{{ Form::password('password', ['placeholder' => 'Пароль']) }}
	{{ Form::submit('Войти',['class' => 'submit']) }}

	{{ Form::close() }}


	{{ Form::open(array('route' => 'register', 'method' => 'post', 'class' => 'sign-up-form')) }}

		<div class="email">
			{{ 
				Form::text('email', null, ['placeholder' => 'Ваш email', 'class' => 'email-input']) 
			}}
			<div class="load-icons">
				<img src="img/load.gif" alt="" class="load">
				<img src="img/fail.png" alt="" class="fail">
				<img src="img/success.png" alt="" class="success">
			</div>
		</div>

		<div class="pass1">
			{{ 
				Form::password('password', ['placeholder' => 'Введите пароль', 'class' => 'pass1-input']) 
			}}
			<div class="load-icons">
				<img src="img/load.gif" alt="" class="load">
				<img src="img/fail.png" alt="" class="fail">
				<img src="img/success.png" alt="" class="success">
			</div>
		</div>
		<div class="pass2">
			{{ 
				Form::password('repeat_password', ['placeholder' => 'Повторите пароль', 'class' => 'pass2-input'])
			}}
			<div class="load-icons">
				<img src="img/load.gif" alt="" class="load">
				<img src="img/fail.png" alt="" class="fail">
				<img src="img/success.png" alt="" class="success">
			</div>
		</div>

	{{ Form::submit('Зарегистрироваться!',['class' => 'submit']) }}

	{{ Form::close() }}


@stop

@section('footer')
	@parent

	<script src="js/reg.js"></script>
	<script>
		new panel(new form('sign-up-form'),'signUp');

		new panel(new form('login-form'),'login');
	</script>
@stop