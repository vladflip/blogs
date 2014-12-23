@extends('layouts.main')

@section('body')

	<div class="w-posts-main">
		@include('layouts.posts.main.guest.wall_posts')
	</div>

	@if(count($posts)===5)

	<div class="loadmore_post_main" onclick="load_more_main(this)">
		Загрузить еще
	</div>

	@endif

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