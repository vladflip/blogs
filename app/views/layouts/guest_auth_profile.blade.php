@extends('layouts.main')

@section('head')
	@parent
	<meta name="_token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css">
@stop

@section('body')

	<div class="write-msg-block" id="writeMsg">
		{{ Form::open(['route' => 'send_message', 'class' => 'write-msg-from']) }}
			{{ Form::textArea('message', null, ['autocomplete' => 'off', 'class' => 'send-message-input']) }}
			<input type="hidden" name="receiver" value="{{ $user->id }}">
			{{ Form::submit() }}
		{{ Form::close() }}
	</div>

	<div class="profile">

		<div class="p_user-ava-block">

			<div class="p_avatar disabled" id="pAvatar">

				@if(!empty($user->ava_xl)&&file_exists($user->ava_xl))
					<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
				@else
					<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">	
				@endif

			</div>

			<div class="p_write-msg" id="pWriteMsg">
				Написать сообщение
			</div>

			<div class="p_rate-block">
				<div class="p_rate-label">Рейтинг активности</div>
				<div class="p_rate data-in" id="pRate">
					<span>{{ $user->rate }}</span>
				</div>
			</div>

		</div>

		<div class="p_user-info">

			<ul class="p_info-list">

				<li>
					<div class="p_login" id="pLogin">

						<span>
							{{{ $user->login or 'логин' }}}
						</span>

					</div>
				</li>
				
				<li>
					<div class="p_name-block">
						<div class="p_name data-in" id="pName">

							<span>
								{{ $user->name or 'имя' }}
							</span>

						</div>
					</div>
							
					<div class="p_age-block">
						<div class="p_age data-in" id="pAge">
							
							<span>
								{{ $user->age or '0' }}
							</span>

						</div>
					</div>
				</li>
				
				<li>
					<div class="p_town-block">
						<div class="p_town data-in" id="pTown">

							<span>
								{{ $user->town or 'город' }}
							</span>

						</div>
					</div>
				</li>
				
				<li>
					<div class="p_about-block">
						
						@if($user->about)
							<div class="p_about-cap ready">
								{{ $user->about}}
							</div>
						@else
							<div class="p_about-cap disabled">
								{{ 'Нет инфо о пользователе' }}
							</div>
						@endif

					</div>
				</li>
			</ul>

			<div class="p_wall">
				@include('layouts.posts.guest_auth.wall')
			</div>

		</div>
		<div class="clear-fix"></div>
	</div>
@stop

@section('footer')
	@parent

	<script>
		
		function readmore_post(el){
			el.style.display = 'none';
			el.parentNode.getElementsByClassName('s2')[0].style.display = '';
		}

		// -------------------------------------------
		// Write message

		(function(){
			var el = document.getElementById('pWriteMsg');
			var panel = new popUp();

			var form = document.getElementById('writeMsg');

			form.onmousedown = function(e){
				e.stopPropagation();
			}

			el.onclick = function(){
				panel.open();
				panel.pop.appendChild(form);
				form.style.display = 'block';
			}
		})();

		// Write message
		// -------------------------------------------
	</script>

	<script src="js/jquery.js"></script>
	<script src="js/jquery.Jcrop.min.js"></script>
	<script src="js/jquery.autosize.input.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/wall.js"></script>
@stop