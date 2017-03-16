<!DOCTYPE html>
<html lang="es">
<head>
	 {{-- header common --}}
		<meta charset="utf-8">
	    <link rel="shortcut icon" href="assets/img/favicon.ico" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	    <meta name="viewport" content="width=device-width, initial-scale=1" />
	@section('metadata') 
	    <meta name="author" content="@01Comandos">
	    <meta name="description" content="Innovamos la forma de conectar a Reclutadores Ejecutivos alrededor del mundo.">
	    <meta name="keywords" content="gtalents, plataforma de empleos en latinoamerica, plataforma de trabajo en latinoamerica, globaltalentshift">
    @show
   		<title>gTalents</title>
    {{-- css section --}}

		{!! HTML::style('assets/css/materialize.min.css') !!}
		{!! HTML::style('assets/css/style.css') !!}
	   <!-- {!! HTML::style("assets/css/bootstrap.min.css") !!}
	    {!! HTML::style('assets/css/app.css') !!}
	    {!! HTML::style("assets/css/bootstrap-social.css") !!}-->

    @yield('header-scripts')
</head>


 {{-- container section --}}	

@yield('content')

 {{-- js section --}}

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! HTML::script('assets/js/jquery-2.1.1.min.js') !!}
    {!! HTML::script('assets/js/jquery/1.11.1/jquery.min.js') !!}
    {!! HTML::script('assets/js/materialize.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}

	<!-- complementos -->
	{!! HTML::script('assets/js/responsiveslides.min.js') !!}
	{!! HTML::script('assets/js/jquery.nicescroll.js') !!}
    {!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
    
   	<!--EFECTO SCROLL-->
	{!! HTML::script('assets/js/jquery.smoove.min.js') !!}
	{!! HTML::script('assets/js/jquery.smoove.js') !!}
	{!! HTML::script('assets/js/jquery-loader.js') !!}

	<!--SCRIPT PROPIOS-->
    {!! HTML::script('assets/js/as/auth-frontend.js') !!}

    {!! HTML::script('assets/js/as/app.js') !!}
    {!! HTML::script('assets/js/as/btn.js') !!}
    {!! HTML::script('assets/js/as/login.js') !!}
    {!! HTML::script('assets/js/jquery.validate.min.js') !!}

    @yield('scripts')
@show


</body>
</html>