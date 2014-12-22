@if(Auth::check())
	<div class="header">

		<div class="container">
			<div class="h_logo">
				<img src="img/logo.png" alt="">
			</div>
			<div class="h_menu">
				<li><a href="{{ route('home') }}">Главная лента</a></li>
				<li>
					<a href="{{ Auth::user()->login ? route('profile', Auth::user()->login) 
						: route('reg_profile', Auth::user()->id) }}">
						Мой профиль
					</a>
				</li>
				<li><a href="">Мои Сообщения</a></li>
				<li><a href="">Настройки</a></li>
				<li id="logOut">Выйти</li>
			</div>
			<div class="clear-fix"></div>
		</div>
	{{ Form::open(['action' => 'UserController@forget', 'method' => 'post', 'id' => 'logOutForm']) }}
	{{ Form::close() }}
		
		<script>
			if(document.getElementById('logOut')){
				document.getElementById('logOut').onclick = function(){
					document.getElementById('logOutForm').submit();
				}
			}
		</script>
	</div>
@else
	<div class="header">

		<div class="container">
			<div class="h_logo">
				<img src="img/logo.png" alt="">
			</div>
			<div class="h_menu">
				<li><a href="{{ route('home') }}">Главная лента</a></li>
				<li id="signUp">Зарегистрироваться</li>
				<li id="login">Войти</li>
			</div>
			<div class="clear-fix"></div>
		</div>
		
		@include('layouts.reg')
		<script src="js/reg.js"></script>
		<script>
			new panel(new form('sign-up-form'),'signUp');

			new panel(new form('login-form'),'login');
		</script>
	</div>
@endif
