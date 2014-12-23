@extends('layouts.main')

@section('body')
	<div class="w-posts-main">
		@include('layouts.posts.main.wall_posts')
	</div>
	
	@if(count($posts)===5)

	<div class="loadmore_post_main" onclick="load_more_main(this)">
		Загрузить еще
	</div>

	@endif
@stop

@section('footer')
	@parent
	<script src="js/jquery.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/wall.js"></script>
@stop
