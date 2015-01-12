{{-- ------------------------------------ --}}
{{-- add form --}}

<div class="w-p_add-comment">
	<div class="w-p_a-c_in">
		<textarea name="" class="w-p_a-c-input" placeholder="Напишите комментарий"></textarea>
		<div class="submit-comment" onclick="wall.add('{{ md5($v->id.csrf_token()) }}', {{ $v->id }}, this)">
			Отправить
		</div>
	</div>
</div>

{{-- add form --}}
{{-- ------------------------------------ --}}


{{-- ------------------------------------ --}}
{{-- comment block --}}
<?php
	$i = 0;
?>
@foreach ($v->comments as $key => $val)

	@if($i<3)

		<div class="w-p_c-block">
			<hr>
			<div class="w-p_c_ava">
				@if($user->id===$val->user->id)
					<img src="{{ $val->user->ava_sm }}" alt="">
				@else
					<a href="{{ route('profile', $val->user->login) }}">
						<img src="{{ $val->user->ava_sm }}" alt="">
					</a>
				@endif
			</div>
			<div class="w-p_c-c">
				<div class="w-p_c_header">
					{{ $val->user->name }}
				</div>
				<div class="w-p_c_date">
					{{ $val->created_at->day.'.'.$val->created_at->month.'.'.$val->created_at->year }}
				</div>
				<div class="w-p_c_content">
					{{ $val->content }}
				</div>
			</div>

			<div class="w-p_c_like" onclick="like_comment('{{ md5($val->id.$val->id) }}', {{ $val->id }}, this)">
				@if($val->likes->contains(Auth::id()))
					<img src="img/liked.png" alt="" onclick="return false;">
				@else
					<img src="img/not_liked.png" alt="" onclick="return false;">
				@endif
				<span class="cnt_likes">{{ count($val->likes) }}</span>
			</div>
			<div class="clear-fix"></div>
		</div>

	@endif
<?php
	$i++
?>
@endforeach

<?php
	$i = 0;
?>
<div class="load-more-comments-block" style="display:none">
	@foreach ($v->comments as $key => $val)

		@if($i>=3)

			<div class="w-p_c-block">
				<hr>
				<div class="w-p_c_ava">
					@if($user->id===$val->user->id)
						<img src="{{ $val->user->ava_sm }}" alt="">
					@else
						<a href="{{ route('profile', $val->user->login) }}">
							<img src="{{ $val->user->ava_sm }}" alt="">
						</a>
					@endif
				</div>
				<div class="w-p_c-c">
					<div class="w-p_c_header">
						{{ $val->user->name }}
					</div>
					<div class="w-p_c_date">
						{{ $val->created_at->day.'.'.$val->created_at->month.'.'.$val->created_at->year }}
					</div>
					<div class="w-p_c_content">
						{{ $val->content }}
					</div>
				</div>

				<div class="w-p_c_like" onclick="like_comment('{{ md5($val->id.$val->id) }}', {{ $val->id }}, this)">
					@if($val->likes->contains(Auth::id()))
						<img src="img/liked.png" alt="" onclick="return false;">
					@else
						<img src="img/not_liked.png" alt="" onclick="return false;">
					@endif
					<span class="cnt_likes">{{ count($val->likes) }}</span>
				</div>
				<div class="clear-fix"></div>
			</div>
			
		@endif
	<?php
		$i++
	?>
	@endforeach
</div>

{{-- comment block --}}
{{-- ------------------------------------ --}}

@if(count($v->comments)>3)
	<div class="load-more-comments" onclick="load_more_comments(this)">Загрузить коменты</div>
@endif