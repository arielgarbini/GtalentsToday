@extends('layouts.app')

@section('page-title', trans('app.add_candidate'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.candidate_details')
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('candidates.index') }}">@lang('app.candidates')</a></li>
                    <li class="active">@lang('app.create')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<div class="row">
    <div class="col-md-8"> 

        <div role="tabpanel" class="tab-pane active" id="details">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table">
                        <caption> @lang('app.candidate_details')</caption>
                        <tr>
                            <th>@lang('app.first_name')</th>
                            <td>{{ $candidate->first_name ? $candidate->first_name : '-' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('app.last_name')</th>
                            <td>{{ $candidate->last_name ? $candidate->last_name : '-' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('app.email')</th>
                            <td>{{ $candidate->email ? $candidate->email : '-' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('app.code')</th>
                            <td>{{ $candidate->code ? $candidate->code : '-' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('app.resume')</th>
                            <td>@if($candidate->file) <a href="/upload/docs/{{$candidate->file}}">{{$candidate->file}}</a> @else - @endif</td>
                        </tr>
                        <tr>
                            <th>@lang('app.status')</th>
                            <td>{{ $candidate->is_active ? trans('app.active') : trans('app.inactive') }}
                             </td>
                        </tr>
                     
                    </table>
                </div>
            </div> 
        </div> 
    </div>           
</div>


<div class="row">
    <div class="col-md-12">
        <a href="{{route('candidates.index.admin')}}"><button type="button" class="btn btn-primary">
            <i class="fa fa-arrow-left "></i>
            @lang('app.back')
        </button></a>
    </div>
</div>

@stop
