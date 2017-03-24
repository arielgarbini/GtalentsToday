<!doctype html>
<!-- Adaptación Nuevo Panel de Usuarios-->
<html lang="en">
<head>
    {{-- header common --}}
        <meta charset="utf-8">
        <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    @section('metadata') 
        <meta name="author" content="@01Comandos">
        <meta name="description" content="Innovamos la forma de conectar a Reclutadores Ejecutivos alrededor del mundo.">
        <meta name="keywords" content="gtalents, plataforma de empleos en latinoamerica, plataforma de trabajo en latinoamerica, globaltalentshift">
    @show
       <!-- <title>gTalents</title>-->

    <title>@yield('page-title') | {{ settings('app_name') }}</title>

    {{-- css section --}}
    {!! HTML::style('assets/css/materialize.min.css') !!}
    {!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('assets/css/intlTelInput.css') !!}

    <!-- NEW POST-->
    {!! HTML::style('assets/css/demo.css') !!} 
    {!! HTML::style('assets/css/component.css') !!}

     <!--ESTILOS TOOLTIP-->
    {!! HTML::style('assets/css/hint.css') !!}
    <!-- FIN DE ESTILOS -->

    @yield('styles')
</head>
<body class="body-registered">

    @include('partials.header-registrado')

        <div class="container-fluid">
            {{-- container section --}}  
            @yield('content')
        </div>
   
    {{-- js section --}}

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! HTML::script('assets/js/jquery-2.1.1.min.js') !!}

    <!--{!! HTML::script('assets/js/jquery/1.11.1/jquery.min.js') !!}-->

    {!! HTML::script('assets/js/materialize.min.js') !!}
    <!--{!! HTML::script('assets/js/bootstrap.min.js') !!}-->

    <!-- complementos -->
    {!! HTML::script('assets/js/responsiveslides.min.js') !!}
    {!! HTML::script('assets/js/jquery.nicescroll.js') !!}
   {!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}

    <!--EFECTO SCROLL-->
    {!! HTML::script('assets/js/jquery.smoove.min.js') !!}
    {!! HTML::script('assets/js/jquery.smoove.js') !!}
    {!! HTML::script('assets/js/jquery-loader.js') !!}    

    <!--BANDEJAS TELEFONO-->
    {!! HTML::script('assets/js/intlTelInput.js') !!}

    <!-- UPLOAD-->
    {!! HTML::script('assets/js/custom-file-input.js') !!}

    <!--ESTRELLAS-->
    {!! HTML::script('assets/js/jquery.barrating.js') !!}
    {!! HTML::script('assets/js/examples-barrating.js') !!}
 
    <!--SCRIPT PROPIOS-->
    {!! HTML::script('assets/js/as/auth-frontend.js') !!}

<!--    {!! HTML::script('assets/js/jquery.validate.min.js') !!} -->
    <script>
        $(document).ready(function(){
            $('.send_form').click(function(){
                $(this).parent().submit();
            });
        });
    </script>
    @yield('scripts')
    @show
</body>
</html>



