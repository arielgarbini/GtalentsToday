<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title') | {{ settings('app_name') }}</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('assets/img/icons/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url('assets/img/icons/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/ico" href="{{ url('assets/img/icons/favicon.ico') }}" />
    <meta name="application-name" content="{{ settings('app_name') }}"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="{{ url('assets/img/icons/favicon.ico') }}" />

    {{-- For production, it is recommended to combine following styles into one. --}}
    {!! HTML::style('assets/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/css/font-awesome.min.css') !!}
    {!! HTML::style('assets/css/metisMenu.css') !!}
    {!! HTML::style('assets/css/sweetalert.css') !!}
    {!! HTML::style('assets/css/bootstrap-social.css') !!}
    {!! HTML::style('assets/css/app.css') !!}
    {!! HTML::style('assets/css/bootstrap-multiselect.css') !!}
    {!! HTML::style("assets/css/styles.css") !!}
    {!! HTML::style('assets/css/intlTelInput.css') !!}

    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="{{ url('assets/img/icons/gtalents-logo.png') }}" alt="{{ settings('app_name') }}" style="width: 100%;margin-left: 0px;margin-top: -30px;">
                </a>
            </div>

            <div id="navbar" class="navbar-collapse">
                <a href="#" id="sidebar-toggle" class="btn">
                    <i class="navbar-icon fa fa-bars icon"></i>
                </a>
               
                 <ul class="nav navbar-nav navbar-left">
                    <li><a href="{{ url('lang', ['es']) }}">@lang('app.spanish')</a></li>
                    <li><a href="{{ url('lang', ['en']) }}">@lang('app.english')</a></li>
                  </ul>
            


                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle avatar" data-toggle="dropdown">
                            <img alt="image" class="img-circle" src="{{ Auth::user()->present()->avatar }}">
                            {{ Auth::user()->present()->name }}
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user_details') }}">
                                    <i class="fa fa-user"></i>
                                    @lang('app.my_user_details')
                                </a>
                            </li>
                            @if (config('session.driver') == 'database')
                                <li>
                                    <a href="{{ route('user_details.sessions') }}">
                                        <i class="fa fa-list"></i>
                                        @lang('app.active_sessions')
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('auth.logout') }}">
                                    <i class="fa fa-sign-out"></i>
                                    @lang('app.logout')
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @include('partials.sidebar')

    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>

    {{-- For production, it is recommended to combine following scripts into one. --}}
    {!! HTML::script('assets/js/jquery-2.1.4.min.js') !!}
    {!! HTML::script('assets/js/bootstrap.min.js') !!}
    {!! HTML::script('assets/js/metisMenu.min.js') !!}
    {!! HTML::script('assets/js/sweetalert.min.js') !!}
    {!! HTML::script('assets/js/delete.handler.js') !!}
    {!! HTML::script('assets/plugins/js-cookie/js.cookie.js') !!}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    </script>
    {!! HTML::script('vendor/jsvalidation/js/jsvalidation.js') !!}
    {!! HTML::script('assets/js/as/app.js') !!}

    <!--SCRIPT PROPIOS-->
    {!! HTML::script('assets/js/intlTelInput.js') !!}
    {!! HTML::script('assets/js/as/auth-frontend.js') !!}
    @yield('scripts')
</body>
</html>
