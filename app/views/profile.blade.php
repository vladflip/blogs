@extends('layouts.main')

@section('head')
	@parent
	<meta name="_token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css">
@stop

@section('body')
	<div class="p_file-read" id="pFileRead">
		<div class="img-par" id="imgPar">
			Загрузить фото!
		</div>
		<div class="j-crop" id="jCrop">
			
		</div>
	</div>
	<div class="profile">
			{{ Form::open(['files' => true, 'class' => 'img-in', 'id' => 'imgIn']) }}
				{{ Form::file('avatar', ['id' => 'openAva']) }}
			{{ Form::close() }}
		<div class="p_header">
			<div class="p_avatar" id="pAvatar">
				<img src="img/flag.jpg" alt="">
			</div>

			<div class="p_content">
				<div class="p_login" id="pLogin">логин</div>
				<ul class="p_info-list">
					<li>
						<div class="p_label">
							Полное имя
						</div>
						<div class="p_spacer">:</div>
						<div class="p_full-name data-in" id="pFullName">_ _ _ _ _</div>
					</li>
					<li>
						<div class="p_label">
							Возраст
						</div>
						<div class="p_spacer">:</div>
						<div class="p_age data-in" id="pAge">_ _ _ _ _</div>
					</li>
					<li>
						<div class="p_label">
							День Рождения
						</div>
						<div class="p_spacer">:</div>
						<div class="p_b-day data-in" id="pBDay">_ _ _ _ _</div>
					</li>
					<li>
						<div class="p_label">
							Город
						</div>
						<div class="p_spacer">:</div>
						<div class="p_town data-in" id="pTown">_ _ _ _ _</div>
					</li>
					<li>
						<div class="p_label">
							Рейтинг
						</div>
						<div class="p_spacer">:</div>
						<div class="p_rate data-in" id="pRate">_ _ _ _ _</div>
					</li>
					<li>
						<div class="p_label">
							О себе
						</div>
						<div class="p_spacer">:</div>
						<div class="p_about data-in" id="pAbout">_ _ _ _ _</div>
					</li>
				</ul>
			</div>

		</div>
	</div>
@stop

@section('footer')
	@parent
	<script src="js/jquery.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	<script src="js/profile.js"></script>
@stop