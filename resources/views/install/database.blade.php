@extends('layouts.install')

@section('content')

    @include('install.steps', ['steps' => [
        'welcome' => 'selected done',
        'requirements' => 'selected done',
        'permissions' => 'selected done',
        'database' => 'selected'
    ]])

    @include('partials.messages')

    {!! Form::open(['route' => 'install.installation']) !!}
        <div class="step-content">
            <h3>@lang('app.database_info')</h3>
            <hr>
            <div class="form-group">
                <label for="host">Host</label>
                <input type="text" class="form-control" id="host" name="host" value="{{ old('host') }}">
                <small>@lang('app.Database host. Usually you should enter localhost or mysql.')</small>
            </div>
            <div class="form-group">
                <label for="username">@lang('app.username')</label>
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}">
                <small>@lang('app.Your database username.')</small>
            </div>
            <div class="form-group">
                <label for="password">@lang('app.password')</label>
                <input type="password" class="form-control" id="password" name="password">
                <small>@lang('app.Database password for provided username.')</small>
            </div>
            <div class="form-group">
                <label for="database">@lang('app.Database Name')</label>
                <input type="text" class="form-control" id="database" name="database"  value="{{ old('database') }}">
                <small>@lang('app.Name of database where tables should be created.')</small>
            </div>
            <div class="form-group">
                <label for="prefix">@lang('app.Tables Prefix')</label>
                <input type="text" class="form-control" id="prefix" name="prefix" value="{{ old('prefix') }}">
                <small>@lang('app.Prefix to put in front of database table names. You can leave it blank if you want.')</small>
            </div>
            <button class="btn btn-green pull-right">
                @lang('app.next')
                <i class="fa fa-arrow-right"></i>
            </button>
            <div class="clearfix"></div>
        </div>
    {!! Form::close() !!}

@stop