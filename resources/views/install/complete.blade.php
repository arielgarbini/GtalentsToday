@extends('layouts.install')

@section('content')

    @include('install.steps', ['steps' => [
        'welcome' => 'selected done',
        'requirements' => 'selected done',
        'permissions' => 'selected done',
        'database' => 'selected done',
        'installation' => 'selected done',
        'complete' => 'selected'
    ]])

    <div class="step-content">
        <h3>@lang('app.complete')!</h3>
        <hr>
        <p><strong>@lang('app.Well Done!')</strong></p>
        <p>@lang('app.You application is now successfully installed! You can login by clicking on "Log In" button below.')</p>

        @if (is_writable(base_path()))
            <p><strong>@lang('app.Important!')</strong> @lang('app.Since your root directory is still writable, you can change the permissions to 755 to make it writable only by root user.')</p>
        @endif

        <a class="btn btn-green pull-right" href="{{ url('login') }}">
            <i class="fa fa-sign-in"></i>
            @lang('app.Log In')
        </a>
        <div class="clearfix"></div>
    </div>

@stop