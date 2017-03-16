@extends('layouts.app')

@section('page-title', trans('app.vacancies'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.vacancies')
            <small>@lang('app.list_of_registered_vacancies')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.vacancies')</li>
                </ol>
            </div>

        </h1>
    </div>
</div>
<div></div>
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2">
        @permission('vacancies.create')
            <!--<a href="{{ route('vacancies.create') }}" class="btn btn-success" id="add-vacancy">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_vacancy')
            </a>-->
        @endpermission
    </div>
    <div class="col-md-5"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="vacancies-form">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_vacancies')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-vacancies-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('vacancies.index') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive top-border-table" id="vacancies-table-wrapper">
    <table class="table">
        <thead>
            <th>@lang('app.name')</th>
            <th>@lang('app.positions')</th>
            <th>@lang('app.posted_by')</th>
            <th>@lang('app.status')</th>
            <th class="text-center">@lang('app.action')</th>
        </thead>
        <tbody>
            @if (count($vacancies))
                @foreach ($vacancies as $vacancy)
                    <tr>
                        <td>{{ $vacancy->name }}</td>
                        <td>{{ $vacancy->positions_number }}</td>
                        <td>{{ $vacancy->poster->present()->name }}</td>
                        <td>
                            <span class="label label-{{ $vacancy->vacancy_status_id == 1 ? 'success':'warning' }}">
                                {{ $vacancy->vacancy_status->getNameLang($vacancy->vacancy_status_id)->name }}
                            </span>
                        </td>
                        <td class="text-center">
                            @permission('vacancies.view')
                            <a href="{{ route('vacancies.show', $vacancy->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.view_vacancy')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            @endpermission
                            @permission('vacancies.edit')
                           <!-- <a href="{{ route('vacancies.edit', $vacancy) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_vacancy')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>-->
                            @endpermission
                            @permission('vacancies.delete')
                                <a href="{{ route('vacancies.delete', $vacancy->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_vacancy')"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-method="DELETE"
                                        data-confirm-title="@lang('app.please_confirm')'"
                                        data-confirm-text="@lang('app.are_you_sure_delete_vacancy')"
                                        data-confirm-delete="@lang('app.yes_delete_him')'">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            @endpermission
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

    {!! $vacancies->render() !!}

</div>

@stop
