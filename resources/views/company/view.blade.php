@extends('layouts.app')

@section('page-title', trans('app.company'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.company_details')
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('companies.index') }}">@lang('app.companies')</a></li>
                    <li class="active">@lang('app.show')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

    <div class="row">
        <div class="col-md-8">
               <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                    @lang('app.company_details')
                </a>
            </li>
            <li role="presentation">
                <a href="#consultants" aria-controls="details" role="tab" data-toggle="tab">
                   @lang('app.consultants_associated')
                </a>
            </li>
            <li role="presentation">
                <a href="#profile" aria-controls="details" role="tab" data-toggle="tab">
                    @lang('app.profile')
                </a>
            </li>
            <li role="presentation">
                <a href="#experience" aria-controls="details" role="tab" data-toggle="tab">
                    @lang('app.experience')
                </a>
            </li>

        </ul>
           <!-- Tab panes -->
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="details">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('company.partials.show_details')
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="consultants">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('company.partials.show_consultants')
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('company.partials.show_profile')
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="experience">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('company.partials.show_experience')
                    </div>
                </div>
            </div>
        </div>           
    </div>
</div>


    <div class="row">
        <div class="col-md-12">
            <a href="{{route('companies.index')}}"><button type="button" class="btn btn-primary">
                <i class="fa fa-arrow-left "></i>
                @lang('app.back')
            </button></a>
        </div>
    </div>

@stop
