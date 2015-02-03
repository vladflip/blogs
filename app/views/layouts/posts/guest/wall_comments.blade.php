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
				<a href="{{ $val->user->url() }}">
					<img src="{{ $val->user->ava_sm }}" alt="">
				</a>
			</div>
			<div class="w-p_c-c">
				<div class="w-p_c_header">
					<a href="{{ $val->user->url() }}">
						{{ $val->user->name }}
					</a>
				</div>
				<div class="w-p_c_content">
					{{ $val->content }}
				</div>
			</div>
			
			<div class="w-p_date-like">
				<div class="w-p_c_date">
					{{ $val->created_at->day.'.'.$val->created_at->month.'.'.$val->created_at->year }}
				</div>
				<div class="w-p_c_like disabled">
					<img src="img/not_liked.png" alt="" onclick="return false;">
					
					<span class="cnt_likes">{{ count($val->likes) }}</span>
				</div>
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
					<a href="{{ $val->user->url() }}">
						<img src="{{ $val->user->ava_sm }}" alt="">
					</a>
				</div>
				<div class="w-p_c-c">
					<div class="w-p_c_header">
						<a href="{{ $val->user->url() }}">
							{{ $val->user->name }}
						</a>
					</div>
					<div class="w-p_c_content">
						{{ $val->content }}
					</div>
				</div>

				<div class="w-p_date-like">
					<div class="w-p_c_date">
						{{ $val->created_at->day.'.'.$val->created_at->month.'.'.$val->created_at->year }}
					</div>
					<div class="w-p_c_like disabled">
						<img src="img/not_liked.png" alt="" onclick="return false;">
						
						<span class="cnt_likes">{{ count($val->likes) }}</span>
					</div>
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