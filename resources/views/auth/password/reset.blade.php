@extends('layouts.master')

@section('title')
    trans('app.reset_password')
@stop
@section('css')
    @parent
@stop

@section('content')
    <body class="body-login">
    <!--CONTENEDOR PADRE PARA LOGIN-->
    <article class="login">
        <!--TITULO DE LA SECCION-->
        <section class="login-title">
            <figure>
                <a href="{{ URL('/') }}">
                    <img src="{{URL::to('/assets/img/logotipo.png')}}" alt="gtalents logotipo">
                </a>
            </figure>
            <p>@lang('app.one_account_many_benefits')</p>
        </section>

    {{-- This will simply include partials/messages.blade.php view here --}}
    @include('partials/messages')

    <!--FORMULARIO login-->
        @include('partials.messages')
        <form role="form" action="{{ URL::to('/password/reset') }}" class="formLogin" method="POST" id="login-container" autocomplete="off">

            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="itemForm">
                <label for="email" >@lang('app.your_email')</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="@lang('app.your_email')">
            </div>

            <!--CONTRASEÑA-->
            <div class="itemForm">
                <label for="password" class="sr-only">@lang('app.new_password')</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="@lang('app.new_password')">
            </div>

            <div class="itemForm">
                <label for="password_confirmation" class="sr-only">@lang('app.confirm_new_password')</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="@lang('app.confirm_new_password')">
            </div>

            <!--SUBMIT-->
            <div class="submit">
                <button type="submit" class="btn-main2" id="btn-login">
                    @lang('app.update_password')
                </button>
            </div>

        </form>

    </article>

@stop