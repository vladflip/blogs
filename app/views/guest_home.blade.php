@extends('layouts.main')

@section('body')

	<div class="w-posts-main">
		<h2 style="margin:0">Записи</h2>

		@include('layouts.posts.main.guest.wall_posts')
		
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
	<script>
		var postsToLoad = 5;
		function load_more_comments(el){
			el.parentNode.getElementsByClassName('load-more-comments-block')[0].style.display = 'block';
			el.style.display = 'none';
		}

		function readmore_post(el){
			el.style.display = 'none';
			el.parentNode.getElementsByClassName('s2')[0].style.display = '';
		}

		function load_more_main(el){
			var loadMore = el;
			var main = document.getElementsByClassName('w-posts-main')[0];
			ajax('post', 'load-more-posts-main', {cnt:postsToLoad}, function(r){
					if(r.indexOf('no posts')!==-1){	
						loadMore.classList.add('no-posts');
						loadMore.onclick = null;
					} else {
						var span = document.createElement('span');
						span.innerHTML = r;
						main.appendChild(span);
					}
				});
				postsToLoad+=5;
		}
	</script>
@stop