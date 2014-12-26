@extends('layouts.main')

@section('body')
	<div class="w-posts-main">
		<h2 style="margin:0">Записи</h2>
		@include('layouts.posts.main.wall_posts')
		<div class="clear-fix"></div>
	</div>

	<div class="right-main-block">

		<div class="rate-block">
			<div class="r-b_header">
				<h2>Рейтинг</h2>
				<span>
					<a href="">все</a>
				</span>
			</div>
			<div class="r-b_content">
				@include('layouts.rate')
			</div>
		</div>
		<!-- ==================================== -->
		<div class="popular-news-block">
			<div class="p-n_header">
				<h2>Популярные</h2>
				<span>
					<a href="">все</a>
				</span>
			</div>
			<div class="p-n_content">
				@include('layouts.popular')
			</div>
		</div>
	</div>

	@if(count($posts)===5)
		<div class="loadmore_post_main" onclick="load_more_main(this)">
			Загрузить еще
		</div>
	@endif

	<div class="clear-fix"></div>
	
@stop

@section('footer')
	@parent
	<script src="js/jquery.js"></script>
	<script src="js/jquery.autosize.min.js"></script>
	<script src="js/wall.js"></script>
@stop
