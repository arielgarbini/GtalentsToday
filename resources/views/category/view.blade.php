@extends('layouts.app')

@section('page-title', trans('app.add_category'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.category_details')
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('categories.index') }}">@lang('app.categories')</a></li>
                    <li class="active">@lang('app.show')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<div class="row">

    <div class="col-lg-4 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('app.details')
                <div class="pull-right">
                    <a href="{{ route('categories.edit', $category->id) }}" class="edit"
                       data-toggle="tooltip" data-placement="top" title="@lang('app.edit_category')">
                        @lang('app.edit')
                    </a>
                </div>
            </div>
            <div class="panel-body panel-profile">
                <div class="image">
                    <br>
                    <img alt="image" class="img-circle" src="{{ $category->avatar ? url('upload/categories/'.$category->avatar) : url('assets/img/profile.png') }}">

                    <div class="name"> <strong>{{ $category->name }}</strong></div>
                    <br>
                    <div class="name">
                        @lang('app.code') - <strong>{{ $category->code }}</strong>
                    </div>
                    <div class="name">
                        @lang('app.status') - <strong>{{ $category->is_active == 1 ? trans('app.active') : trans('app.inactive') }}</strong>
                    </div>
                    <br>

                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-8"> 

        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('app.requirements')
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>@lang('app.required_points')</th>
                        <td>{{ $category->required_points }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.poster_percent')</th>
                        <td>{{ $category->poster_percent . ' %' }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.supplier_percent')</th>
                        <td>{{ $category->supplier_percent . ' %' }}</td>
                    </tr>
                    <tr>
                        <th>@lang('app.gtalents_percent')</th>
                        <td>{{ $category->gtalents_percent . ' %' }}</td>
                    </tr>
                </table>
            </div>
        </div> 
    </div>           
</div>


<div class="row">
    <div class="col-md-12">
        <a href="{{route('categories.index')}}"><button type="button" class="btn btn-primary">
            <i class="fa fa-arrow-left "></i>
            @lang('app.back')
        </button></a>
    </div>
</div>

@stop
