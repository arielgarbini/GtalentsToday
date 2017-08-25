@extends('layouts.app')

@section('page-title', trans('app.candidates'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.candidates')
            <small>@lang('app.list_of_registered_candidates')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.candidates')</li>
                </ol>
            </div>

        </h1>
    </div>
</div>
<div></div>
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2">
        <a href="{{ route('candidates.create') }}" class="btn btn-success" id="add-candidate">
            <i class="glyphicon glyphicon-plus"></i>
            @lang('app.add_candidate')
        </a>
    </div>
    <div class="col-md-5"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="candidates-form">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_candidates')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-candidates-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('candidates.index.admin') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive top-border-table" id="candidates-table-wrapper">
    <table class="table">
        <thead>
            <th>@lang('app.first_name')</th>
            <th>@lang('app.last_name')</th>
            <th>@lang('app.email')</th>
            <th>@lang('app.date')</th>
            <th class="text-center">@lang('app.action')</th>
        </thead>
        <tbody>
            @if (count($candidates))
                @foreach ($candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->first_name }}</td>
                        <td>{{ $candidate->last_name }}</td>
                        <td>{{ $candidate->email }}</td>
                        <td>{{ $candidate->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('candidates.show', $candidate->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.view_candidate')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <a href="{{ route('candidates.edit', $candidate) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_candidate')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('candidates.delete', $candidate->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_candidate')"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-method="DELETE"
                                    data-confirm-title="@lang('app.please_confirm')'"
                                    data-confirm-text="@lang('app.are_you_sure_delete_candidate')"
                                    data-confirm-delete="@lang('app.yes_delete_him')'">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
            @else
                <tr>
                    <td colspan="6"><em>@lang('app.no_records_found')</em></td>
                </tr>
            @endif
        </tbody>
    </table>


</div>   

@stop

@section('scripts')
    {!! HTML::script('assets/js/modal_message.js') !!}
@stop
