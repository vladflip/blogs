<!DOCTYPE html>
<html lang="en">
<head>
	@section('head')
		<meta charset="UTF-8">
		<meta name="description" content="блоги патриотки, социальная сеть молодежной женской организации, блог молодежной женской организации, патриотки, блог, блоги">
		<meta name="_token" content="{{ csrf_token() }}" >
		<title>Блоги | Патриотки</title>
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="author" href="http://vk.com/vlad.flip">
		<script src="js/inc.js"></script>
	@show
</head>
<body>
	<div class="pop-up" id="popUp"></div>

	@include('layouts.header')

	<div class="container">
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
		@show
	</div>
</body>
</html>
