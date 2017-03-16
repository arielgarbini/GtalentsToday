@extends('layouts.app')

@section('page-title', trans('app.add_new'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.new_details')
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('news.index') }}">@lang('app.news')</a></li>
                    <li class="active">@lang('app.show')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<div class="row">
    <div class="col-lg-8 col-md-8"> 
        <div class="panel panel-default">
            <div class="panel-body">
                <span class="pull-right small">
                    @lang('app.published'): {{ $new->created_at->diffForHumans() }}

                    <a href="{{ route('news.edit', $new->id) }}" title="@lang('app.edit')">
                        <i class="fa fa-pencil fa-fw"></i>
                    </a>
                </span>
                <h3>{{ $new->title }}</h3> 
                <caption>{{ $new->section }}</caption>
                <hr />
                <h4>@lang('app.description')</h4>
                <p>{{ $new->description }}</p>                 
            </div>
        </div> 
    </div>
      
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <a href="{{route('news.index')}}"><button type="button" class="btn btn-primary">
            <i class="fa fa-arrow-left "></i>
            @lang('app.back')
        </button></a>
    </div>
</div>

@stop
