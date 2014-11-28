@foreach($posts as $k => $v)
	<li class="main-post">

		<h1 class="m-p_header">
			<a href="{{ route('post',$v->id) }}">
				{{ $v->header }}
			</a>
		</h1>

		<div class="m-p_c-block">
			<div class="m-p_ava">
				<a href="{{ route('profile', $v->user->id) }}">
					<img src="{{ $v->user->ava_xl }}" alt="">
				</a>
			</div>
			<div class="m-p_excerpt">
				{{ substr($v->content, 0, 300) }}
				<a href="{{ route('post',$v->id) }}">(...)</a>
			</div>
		</div>
		
		<div class="m-p_info">
			<div class="m-p_author">
				<a href="{{ route('profile', $v->user->id) }}">
					{{ $v->user->firstname. ' ' .$v->user->lastname }}
				</a>
			</div>
			<div class="m-p_date">
				{{ $v->created_at->day.'.'.$v->created_at->month.'.'.$v->created_at->year.
					', '.$v->created_at->hour.':'.$v->created_at->minute }}
			</div>
			<div class="m-p_comments">
				<a href="{{ route('post',$v->id) }}">
					{{ '('.count($v->comments).')' }}	
				</a>
			</div>
			<div class="m-p_likes">
				@if($v->likes->contains(Auth::id()))
					<img src="img/liked.png" alt="">
				@else
					<img src="img/not_liked.png" alt="">
				@endif

				{{ count($v->likes) }}
			</div>
		</div>
	</li>
@endforeach