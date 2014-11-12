<!DOCTYPE html>
<html lang="en">
<head>
	@section('head')
		<meta charset="UTF-8">
		<title>Blogs</title>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
	@show
</head>
<body>
	<div class="pop-up" id="popUp"></div>
	<div class="container">
		@section('header')

			<div class="header">
				<div class="h_logo">
					<img src="img/logo.png" alt="">
				</div>
				<div class="h_menu">
					<li><a href="">Главная</a></li>
					<li><a href="">О нас</a></li>
					<li><a href="">Новости</a></li>
					<li><a href="">Проекты</a></li>
					<li><a href="">Участницы</a></li>
					<li><a href="">Партнеры</a></li>
					<li><a href="">Контакты</a></li>
				</div>
			</div>

		@show

		@section('body')
			
		@show

		@section('footer')
			<hr class="f_hr">
			<div class="footer">
				<div class="f_icons">
					<a href="">
						<span class="fa fa-facebook"></span>
					</a>
					<a href="">
						<span class="f_vk">В</span>
					</a>
				</div>
				<div>© "Молодежная Женская Ассоциация" 2014 год.</div>
			</div>
			<script src="js/inc.js"></script>
		@show
	</div>
</body>
</html>
