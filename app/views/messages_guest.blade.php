@extends('layouts/main')

@section('body')
	войдите что бы прочитать сообщения
@stop

@section('footer')
	@parent
	
	<script>
		setTimeout(function(){
			document.getElementById('login').click();
		}, 300);
	</script>
@stop