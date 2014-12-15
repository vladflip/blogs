@extends('layouts.main')

@section('head')
	@parent
	<meta name="_token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="css/jquery.Jcrop.min.css">
@stop

@section('body')
	<div class="profile">

		<div class="p_user-ava-block">

			<div class="p_avatar disabled" id="pAvatar">

				@if(!empty($user->ava_xl)&&file_exists($user->ava_xl))
					<img id="avaEl" src="{{ $user->ava_xl }}" alt="">
				@else
					<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">	
				@endif

			</div>

			<div class="p_rate-block">
				<div class="p_rate-label">Рейтинг активности</div>
				<div class="p_rate data-in" id="pRate">0</div>
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
				@include('layouts.posts.guest.wall')
			</div>

		</div>
	</div>
@stop

@section('footer')
	@parent

	<script>
		
		function readmore_post(el){
			el.style.display = 'none';
			el.parentNode.getElementsByClassName('s2')[0].style.display = '';
		}
	</script>
@stop