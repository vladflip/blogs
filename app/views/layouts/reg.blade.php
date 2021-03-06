{{ Form::open(array('route' => 'login', 'method' => 'post','class' => 'login-form')) }}

		{{ Form::text('login', null, ['placeholder' => 'Email']) }}
		{{ Form::password('password', ['placeholder' => 'Пароль']) }}
		{{ Form::submit('Войти',['class' => 'submit']) }}

	{{ Form::close() }}


	{{ Form::open(array('route' => 'register', 'method' => 'post', 'class' => 'sign-up-form')) }}

		<div class="email">
			{{ 
				Form::text('email', null, ['placeholder' => 'Ваш email', 'class' => 'email-input',
					'autocomplete' => 'off']) 
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