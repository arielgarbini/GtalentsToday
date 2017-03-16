@extends('layouts.master')
	
	@section('title')
		@parent
	@stop
	@section('css')
		@parent
	@stop

@section('content')
<body class="body404">

	<section class="body404-text">
		<h3>WHOOOOPS</h3>
		<h1>ERROR 404</h1>
		<p class="p404">Estamos conscientes del problema y lo estamos corrigiendo 
			<br>Gracias por tu apoyo
		</p>
		<div class="body404-text-button">
			<a href="{{ URL('/') }}" class="btn-main">Regresar a gTalents</a>
		</div>
	</section>

@include('partials.footer')
@stop