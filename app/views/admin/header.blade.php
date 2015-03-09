<?php
	$name = Route::current()->getName();
	$class = '';

	if($name == 'admin.users')
		$class = 'users';
	else
		$class = 'posts';

?>
<table class="pure-table admin-header {{ $class }}">
	<tr>
		<td>
			<a href="{{ route('admin.posts') }}">Посты</a>
		</td>
		<td>
			<a href="{{ route('admin.users') }}">Юзеры</a>
		</td>
	</tr>
</table>