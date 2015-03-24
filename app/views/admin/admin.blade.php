@extends('layouts.main')

@section('head')
	@parent
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-nr-min.css">
	<script src="{{ URL::asset('js/jquery.js') }}"></script>
@stop

@section('body')

	@include('admin.header')

	<table class="pure-table pure-table-bordered pure-table-striped admin-table">
		@section('table')
		
		@show
	</table>

@stop

@section('footer')
	@parent
	<script src="{{ URL::to('/') }}/js/admin.js"></script>
@stop