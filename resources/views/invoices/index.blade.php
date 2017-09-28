@extends('layouts.app')

@section('page-title', trans('app.invoices'))

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.invoices')
                <small>@lang('app.list_of_registered_invoices')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.invoices')</li>
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
                    <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_invoices')">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-vacancies-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                        @if (Input::has('search') && Input::get('search') != '')
                            <a href="{{ route('invoices.list') }}" class="btn btn-danger" type="button" >
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
            <th>Supplier</th>
            <th>@lang('app.poster')</th>
            <th>@lang('app.date_of_admission')</th>
            <th>@lang('app.amount')</th>
            <th>@lang('app.type')</th>
            <th>@lang('app.status')</th>
            <th class="text-center">@lang('app.action')</th>
            </thead>
            <tbody>
            @if (count($invoices))
                @foreach ($invoices as $inv)
                    <tr>
                        <td>{{$inv->name}}</td>
                        <td>{{$inv->supplier_user->first_name.' '.$inv->supplier_user->last_name}}</td>
                        <td>
                            @if($inv->poster_user!=NULL)
                            {{$inv->poster_user->first_name.' '.$inv->poster_user->last_name}}
                            @else
                                {{$inv->vacancy->poster->first_name.' '.$inv->vacancy->poster->last_name}}
                            @endif
                        </td>
                        <td>{{$inv->date_of_admission}}</td>
                        <td>
                            {{number_format($inv->amount, 2)}}$
                        </td>
                        <td>
                            @if($inv->poster_user!=NULL)
@lang('app.invoices_pay')
                            @else
@lang('app.invoices_charged')
                            @endif
                        </td>
                        <td>
                            <span class="label label-{{ $inv->status == 'Confirm' ? 'success':'warning' }}">
                                @lang('app.'.$inv->status)
                            </span>
                        </td>
                        <td class="text-center">
                            <!--<a href="{{ route('invoices.show', $inv->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.view_invoice')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>-->
                            <a href="{{ route('invoices.edit', $inv) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_invoice')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('invoices.delete', $inv->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_invoice')"
                               data-toggle="tooltip"
                               data-placement="top"
                               data-method="DELETE"
                               data-confirm-title="@lang('app.please_confirm')"
                               data-confirm-text="@lang('app.are_you_sure_delete_invoice')"
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
