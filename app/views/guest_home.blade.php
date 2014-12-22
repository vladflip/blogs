@extends('layouts.main')

@section('body')

	<ul class="main-posts guest-home">
		@include('layouts.posts.guest_main_posts')
	</ul>

@stop

@section('footer')
	@parent
@stop