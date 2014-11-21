@extends('layouts.main')

@section('head')
	@parent
	<meta name="_token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css">
@stop

@section('body')
	<div class="p_file-read" id="pFileRead">
		<div class="p_section-pane" id="pSecitonPane">
			<div class="img-par" id="imgPar">
				Загрузить фото!
			</div>
			<div class="j-crop" id="jCrop">
				
			</div>
			<div class="p_ava-btns-par" id="pAvaBtns">
				<div class="p_submit-ava" id="pSubmitAva">
					Применить!
				</div>
				<div class="p_undo-ava" id="pUndoAva">
					Отменить!
				</div>
			</div>
		</div>
	</div>
	<div class="profile">
			{{ Form::open(['files' => true, 'route' => 'edit_ava', 'class' => 'img-in', 'id' => 'imgIn']) }}
				{{ Form::file('avatar', ['id' => 'openAva']) }}
				{{ Form::submit('asdf') }}
			{{ Form::close() }}
		<div class="p_header">
			<div class="p_avatar" id="pAvatar">
				@yield('ava_xl')
			</div>

			<div class="p_content">
				<div class="p_login" id="pLogin">
					@yield('login')
					<div class="load-icons">
						<img src="img/load.gif" alt="" class="load">
						<img src="img/fail.png" alt="" class="fail">
						<img src="img/success.png" alt="" class="success">
					</div>
				</div>
				<ul class="p_info-list">
					<li>
						<div class="p_label">
							Имя
						</div>
						<div class="p_spacer">:</div>
						<div class="p_first-name data-in" id="pFirstName">
							@yield('fname')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
							</div>
						</div>
					</li>
					<li>
						<div class="p_label">
							Фамилия
						</div>
						<div class="p_spacer">:</div>
						<div class="p_last-name data-in" id="pLastName">
							@yield('lname')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
							</div>
						</div>
					</li>
					<li>
						<div class="p_label">
							Возраст
						</div>
						<div class="p_spacer">:</div>
						<div class="p_age data-in" id="pAge">
							@yield('age')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
							</div>
						</div>
					</li>
					<!-- <li>
						<div class="p_label">
							День Рождения
						</div>
						<div class="p_spacer">:</div>
						<div class="p_b-day data-in" id="pBDay">
							<input type="text" placeholder="др">
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
							</div>
						</div>
					</li> -->
					<li>
						<div class="p_label">
							Город
						</div>
						<div class="p_spacer">:</div>
						<div class="p_town data-in" id="pTown">
							@yield('town')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
							</div>
						</div>
					</li>
					<li>
						<div class="p_label">
							Рейтинг
						</div>
						<div class="p_spacer">:</div>
						<div class="p_rate data-in" id="pRate">0</div>
					</li>
					<li>
						<div class="p_label">
							О себе
						</div>
						<div class="p_spacer">:</div>
						<div class="p_about data-in" id="pAbout">о себе</div>
					</li>
				</ul>
			</div>

		</div>
	</div>
@stop

@section('footer')
	@parent
	@yield('profile.js')
@stop