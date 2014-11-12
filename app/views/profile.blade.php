@extends('layouts.main')

@section('head')
	@parent
	<meta name="_token" content="{{ csrf_token() }}" />
@stop

@section('body')
	<ul class="profile">

		<li class="p_av-log">
			<div class="p_av" id="avatar">
				
			</div>
			<h3 class="p_log">
				fuckyou
			</h3>
		</li>
		<li class="">
			
		</li>
		<li class="">
			
		</li>
		<li class="">
			
		</li>
		
	</ul>
@stop

@section('footer')
	@parent

	<script src="js/profile.js"></script>
@stop