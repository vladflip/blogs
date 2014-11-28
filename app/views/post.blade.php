@extends('layouts.main')

@section('body')
	<h1>{{ $post->header }}</h1>
	<p>{{ $post->content }}</p>
	<hr>
	<h4>Комментарии ({{ count($post->comments) }})</h4>
		@foreach ($post->comments as $e)
			{{ $e->content }}
		@endforeach
@stop