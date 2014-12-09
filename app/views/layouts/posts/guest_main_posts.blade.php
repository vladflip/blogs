@foreach($posts as $k => $v)
	<li class="main-post">

		<h1 class="m-p_header">
			<a href="{{ route('post',$v->id) }}">
				{{ $v->header }}
			</a>
		</h1>

		<div class="m-p_c-block">
			<div class="m-p_ava">
				<a href="{{ route('profile', $v->user->login) }}">
					@if(!empty($v->user->ava_xl)/*&&file_exists($v->user->ava_xl)*/)
						<img id="avaEl" src="{{ $v->user->ava_xl }}" alt="">
					@else
						<img id="avaEl" src="{{ 'img/q_mark.png' }}" alt="">	
					@endif
				</a>
			</div>
			<div class="m-p_excerpt">
				{{ substr($v->content, 0, 300) }}
				<a href="{{ route('post',$v->id) }}">(...)</a>
			</div>
		</div>
		
		<div class="m-p_info">
			<div class="m-p_author">
				<a href="{{ route('profile', $v->user->login) }}">
					{{ $v->user->name }}
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
			<div class="m-p_likes" onclick="like('{{ md5($v->id.$v->id) }}', {{ $v->id }}, this)">
				@if($v->likes->contains(Auth::id()))
					<img src="img/liked.png" alt="" onclick="return false;">
				@else
					<img src="img/not_liked.png" alt="" onclick="return false;">
				@endif

				<span class="cnt_likes">{{ count($v->likes) }}</span>
			</div>
		</div>
	</li>
@endforeach