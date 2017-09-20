@extends('layouts.master')
	
	@section('title')
		@parent
	@stop
	@section('css')
		@parent
	@stop

@section('content')
<article class="header-index">
		<!-- header-->
		@include('partials.navigation')
</article>

@include('partials.footer')
@stop