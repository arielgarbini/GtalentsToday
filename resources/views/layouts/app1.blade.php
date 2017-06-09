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
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.1/css/materialize.min.css">-->
    {!! HTML::style('assets/css/materialize.min.css') !!}
    {!! HTML::style('assets/css/style.css') !!}
    {!! HTML::style('assets/css/intlTelInput.css') !!}

    <!-- NEW POST-->
    {!! HTML::style('assets/css/demo.css') !!}
    {!! HTML::style('assets/css/component.css') !!}

     <!--ESTILOS TOOLTIP-->
    {!! HTML::style('assets/css/hint.css') !!}
    <!-- FIN DE ESTILOS -->
    {!! HTML::style('assets/css/app.css') !!}

    {!! HTML::style("assets/css/bootstrap-social.css") !!}
    <!-- ESTILOS SWEATALERT -->
    {!! HTML::style('assets/css/sweetalert.css') !!}
    {!! HTML::style('assets/css/chosen.min.css') !!}

    <style>
        .chosen-container{
            margin-top: .35em;
        }

        .chosen-choices{
            box-shadow: none !important;
            background-image: none !important;
        }

        .chosen-choices li span{
            display: block !important;
            color: #333 !important;
        }


    </style>
    @yield('styles')
</head>
<body class="body-registered">

    @include('partials.header-registrado')

        <div class="container-fluid">
            {{-- container section --}}  
            @yield('content')
        </div>
        <div id="loading">
            <div id="loading-content">
                <img id="loading-image" src="/assets/img/waiting.gif" alt="waiting..." />
                <div id="loading-text"></div>
            </div>
        </div>
   
    {{-- js section --}}

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {!! HTML::script('assets/js/jquery-2.1.1.min.js') !!}

    <!--{!! HTML::script('assets/js/jquery/1.11.1/jquery.min.js') !!}-->

    {!! HTML::script('assets/js/materializenew.min.js') !!}
    {!! HTML::script('assets/js/materialize.min.js') !!}
    <!--{!! HTML::script('assets/js/bootstrap.min.js') !!}-->

    <!-- complementos -->
    {!! HTML::script('assets/js/responsiveslides.min.js') !!}
    {!! HTML::script('assets/js/jquery.nicescroll.js') !!}
   <!--{!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}-->

    <!--EFECTO SCROLL-->
    {!! HTML::script('assets/js/jquery.smoove.min.js') !!}
    {!! HTML::script('assets/js/jquery.smoove.js') !!}
    <!--{!! HTML::script('assets/js/jquery-loader.js') !!}-->

    <!--BANDEJAS TELEFONO-->
    <!--BANDEJAS TELEFONO-->
    {!! HTML::script('assets/js/intlTelInput.js') !!}

    <!-- UPLOAD-->
    {!! HTML::script('assets/js/custom-file-input.js') !!}

    <!--ESTRELLAS-->
    {!! HTML::script('assets/js/jquery.barrating.js') !!}
    {!! HTML::script('assets/js/examples-barrating.js') !!}

    <!--SCRIPT PROPIOS-->
    {!! HTML::script('assets/js/intlTelInput.js') !!}
    {!! HTML::script('assets/js/as/auth-frontend.js') !!}

    <!-- SCRIPT SWEATALERT -->
    {!! HTML::script('assets/js/sweetalert.min.js') !!}
    {!! HTML::script('assets/js/jquery.validate.min.js') !!}

    {!! HTML::script('assets/js/chosen.jquery.min.js') !!}

    <script>
        $(document).ready(function(){
            $('.notifications-icon').click(function(){
                if($(this).hasClass('notifications-icon')){
                    element = $(this);
                    $.ajax({
                        url: "{{route('read_notifications')}}",
                        data: "_token={{csrf_token()}}",
                        method: "POST",
                        success: function(response){
                            $(element).removeAttr('class');
                            $('#notifications-icon-point').remove();
                            console.log(response);
                        }
                    })
                }
            });

            function menuVacancies() {
                if($(window).width()<=835){
                    $('#dropdown4').hide();
                    if($('#list-vacancies').hasClass('dropdown-button')){
                        $('#list-vacancies').removeClass('dropdown-button');
                        $('#list-vacancies').removeAttr('data-activates');
                    }
                } else {
                    if(!$('#list-vacancies').hasClass('dropdown-button')){
                        $('#list-vacancies').addClass('dropdown-button');
                        $('#list-vacancies').attr('data-activates', 'dropdown1');
                    }
                }
            }
            $('.hamburguer-1').click(function(){
                setTimeout(function(){
                    $('#dropdown4').hide();
                }, 100);
            });

            menuVacancies();
            $(window).resize(function() {
                menuVacancies();
            });
            display = false;
            $('#list-vacancies').click(function(e){
                if($(window).width()<=835){
                    $('#dropdown4').hide();
                    $('.list-vaca').slideToggle('slow');
                }
            });

            $(".btn-viewMore").click(function(){

                $(this).parent().parent().find('.listado-post').toggleClass("ul-complete");
                $(this).parent().parent().find('.pagination').toggleClass("pagination-on");

                $(this).html(($(this).text() == 'ver menos' || $(this).text() == 'see less') ? '{{trans('app.see_more')}}' : '{{trans('app.see_less')}}');
            });
           // $('.modal').modal();
            $('.send_form').click(function(){
                $(this).parent('form').submit();
            });

            @if (\Session::has('success'))
                swal({
                    title: "{{trans('app.success')}}",
                    text: "{{\Session::get('success')}}",
                    timer: 3000,
                    showConfirmButton: false,
                    type: "success"
                });
            @endif

            @if($errors->all())
                var errors = '<ul>';
                @foreach($errors->all(':message') as $message)
                    errors += '<li style="text-align:left; padding-left: 60px;">{{$message}}</li>';
                @endforeach
                errors += '</ul>';

                swal({
                    title: "{{trans('app.error')}}",
                    text: errors,
                    timer: 3000,
                    html: true,
                    showConfirmButton: false,
                    type: "error"
                });
            @endif
        });

        $(document).ready(function(){
            $('#telf').change(function(){
                $('#phone3').val($('#telf').intlTelInput("getNumber"));
            });
        });
    </script>
    @yield('scripts')
    @show
</body>
</html>



