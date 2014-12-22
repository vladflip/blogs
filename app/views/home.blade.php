@extends('layouts.main')

@section('body')
	<ul class="main-posts">
		@include('layouts.posts.main_posts')
	</ul>
@stop

@section('footer')
	@parent
	<script src="js/main_post.js"></script>
@stop
