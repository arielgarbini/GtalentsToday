@extends('layouts.install')

@section('content')

    @include('install.steps', ['steps' => [
        'welcome' => 'selected done',
        'requirements' => 'selected done',
        'permissions' => 'selected done',
        'database' => 'selected done',
        'installation' => 'selected done',
        'complete' => 'selected error'
    ]])

    <div class="step-content">
        <h3>Whoops!</h3>
        <hr>
        <p><strong>@lang('There was something wrong during the installation!')</strong></p>
        <p>@lang('Please check your log located inside') <code>storage/logs</code> @lang('directory to see what going on.')</p>

        <a class="btn btn-green pull-right" href="{{ route('install.start') }}">
            <i class="fa fa-undo"></i>
            @lang('Try Again')
        </a>
        <div class="clearfix"></div>
    </div>

@stop