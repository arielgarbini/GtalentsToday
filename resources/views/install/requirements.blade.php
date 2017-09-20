@extends('layouts.install')

@section('content')

    @include('install.steps', ['steps' => ['welcome' => 'selected done', 'requirements' => 'selected']])

    @if (! $allLoaded)
        <div class="alert alert-danger">
            <strong>@lang('app.Oh snap!')</strong> @lang('app.Your system does not meet the requirements. You have to fix them in order to continue.')
        </div>
    @endif

    <div class="step-content">
        <h3>@lang('app.system_requirements')</h3>
        <hr>
        <ul class="list-group">
            @foreach ($requirements as $extension => $loaded)
            <li class="list-group-item {{ ! $loaded ? 'list-group-item-danger' : '' }}">
                {{ $extension }}
                @if ($loaded)
                    <span class="badge badge-success"><i class="fa fa-check"></i></span>
                @else
                    <span class="badge badge-danger"><i class="fa fa-times"></i></span>
                @endif
            </li>
            @endforeach
        </ul>
        @if ($allLoaded)
            <a class="btn btn-green pull-right" href="{{ route('install.permissions') }}">
                @lang('app.next')
                <i class="fa fa-arrow-right"></i>
            </a>
        @else
            <button class="btn btn-green pull-right" disabled>
                @lang('app.next')
                <i class="fa fa-arrow-right"></i>
            </button>
        @endif
        <div class="clearfix"></div>
    </div>
@stop