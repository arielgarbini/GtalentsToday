@extends('layouts.app')

@if($edit)
    @section('page-title', trans('app.edit_new'))
@else
    @section('page-title', trans('app.add_new'))
@endif

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? trans('app.edit_new') : trans('app.create_new_new') }}
            <small>@lang('app.new_details')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('news.index') }}">@lang('app.news')</a></li>
                    <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

@if($edit)
    {!! Form::model($new, ['route' => ['news.update', $new->id], 'method' => 'put', 'files' => true, 'id' => 'new-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @include('new.partials.details')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('news.index')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    @lang('app.edit_new')
                </button>
            </div>
        </div>
    {!! Form::close() !!}

@else
    {!! Form::open(['route' => 'news.store', 'files' => true, 'id' => 'new-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @include('new.partials.details', ['edit' => false])
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{route('news.index')}}" class="btn btn-primary">
                    <i class="fa fa-arrow-left "></i>
                    @lang('app.back')
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    @lang('app.create_new')
                </button>
            </div>
        </div>
    {!! Form::close() !!}
@endif

@stop
