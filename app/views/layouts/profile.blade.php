@extends('layouts.main')

@section('head')
	@parent
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css">
@stop

@section('body')

	@if(!isset($not_ready))
		<div class="write-msg-block" id="writeMsg">
			{{ Form::open(['route' => 'send_message', 'class' => 'write-msg-from']) }}
				{{ Form::textArea('message', null, ['autocomplete' => 'off', 'class' => 'send-message-input']) }}
				<input type="hidden" name="receiver" value="{{ $user->id }}">
				{{ Form::submit() }}
			{{ Form::close() }}
		</div>
	@else
		<div id="writeMsg"></div>
	@endif

	<div class="p_file-read" id="pFileRead">
		<div class="p_section-pane" id="pSecitonPane">
			<div class="p_ava-btns-par" id="pAvaBtns">
				<div class="p_submit-ava" id="pSubmitAva">
					Применить!
				</div>
				<div class="p_undo-ava" id="pUndoAva">
					Отменить!
				</div>
			</div>
			<div class="img-par" id="imgPar">
				Загрузить фото!
			</div>
			<div class="j-crop" id="jCrop">
				
			</div>
		</div>
	</div>
	<div class="profile">
			{{ Form::open(['files' => true, 'route' => 'edit_ava', 'class' => 'img-in', 'id' => 'imgIn']) }}
				{{ Form::file('avatar', ['id' => 'openAva']) }}
				{{ Form::submit('asdf') }}
			{{ Form::close() }}

		<div class="p_user-ava-block">

			<div class="p_avatar" id="pAvatar">
				@yield('ava_xl')
			</div>

			@if(!isset($not_ready))
				<div class="p_write-msg" id="pWriteMsg">
					Написать сообщение
				</div>
			@else
				<div id="pWriteMsg"></div>
			@endif

			<div class="p_rate-block">
				<div class="p_rate-label">Рейтинг активности</div>
				<div class="p_rate data-in" id="pRate">
					@yield('rate')
				</div>
			</div>
			
			@if(Auth::user()->online())
				<div class="p_online-block">онлайн</div>
			@endif

		</div>

		<div class="p_user-info">

			<ul class="p_info-list">
				
				<li>
					<div class="p_name-block">
						<div class="p_name data-in" id="pName">
							@yield('name')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
								<div class="edit-pen"></div>
							</div>
						</div>
					</div>
							
					<div class="p_age-block">
						<div class="p_age data-in" id="pAge">
							@yield('age')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
								<div class="edit-pen"></div>
							</div>
						</div>
					</div>
				</li>
				
				<li>
					<div class="p_town-block">
						<div class="p_town data-in" id="pTown">
							@yield('town')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
								<div class="edit-pen"></div>
							</div>
						</div>
					</div>
				</li>
				
				<li>
					<div class="p_about-block">
						@yield('cap')
						<div class="p_about" id="pAbout">
							@yield('about')
							<div class="load-icons">
								<img src="img/load.gif" alt="" class="load">
								<img src="img/fail.png" alt="" class="fail">
								<img src="img/success.png" alt="" class="success">
							</div>
						</div>
					</div>
				</li>
			</ul>
			
			<div class="p_wall" id="pWall">
				@include('layouts.posts.wall')
			</div>
		</div>
		<div class="clear-fix"></div>
	</div>
@stop


@section('footer')
	@parent
	@yield('profile.js')
@stop