@extends('layouts.install')

@section('content')

    @include('install.steps', ['steps' => ['welcome' => 'selected']])

    <div class="step-content">
        <h3>@lang('app.welcome')</h3>
        <hr>
        <p>@lang('app.This steps will guide you through few step installation process.')</p>
        <p>@lang('app.When this installation process is finished, you will be able to login and manage your users immediately!') </p>
        <br>
        <a href="{{ route('install.requirements') }}" class="btn btn-green pull-right" type="button">
            @lang('app.next')
            <i class="fa fa-arrow-right"></i>
        </a>
        <div class="clearfix"></div>
    </div>
@stop