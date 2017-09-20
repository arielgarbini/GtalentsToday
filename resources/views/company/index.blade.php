@extends('layouts.app')

@section('page-title', trans('app.companies'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.companies')
            <small>@lang('app.list_of_registered_companies')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.companies')</li>
                </ol>
            </div>

        </h1>
    </div>
</div>
<div></div>
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2">
        <a href="{{ route('companies.create') }}" class="btn btn-success" id="add-company">
            <i class="glyphicon glyphicon-plus"></i>
            @lang('app.add_company')
        </a>
    </div>
    <div class="col-md-5"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="companies-form">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_companies')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-companies-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('companies.index') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive top-border-table" id="companies-table-wrapper">
    <table class="table">
        <thead>
            <th>@lang('app.companyname')</th>
            <th>@lang('app.website')</th>
            <th>@lang('app.quantity_employees')</th>
            <th>@lang('app.category')</th>
            <th>@lang('app.date_register')</th>
            <th class="text-center">@lang('app.action')</th>
        </thead>
        <tbody>
            @if (count($companies))
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->comercial_name  }}</td>
                        <td>{{ $company->website}}</td>
                        <td>{{ $company->quantity_employees->name}}</td>
                        <td>{{ $company->category->name}}</td>
                        <td>{{ $company->created_at->format('Y-m-d')}}</td>
                        <td class="text-center">
                            <a href="" data-id="" data-target="#modal_points{{$company->id}}" class="open-Modal btn btn-info btn-circle"
                               title="@lang('app.points')" data-toggle="modal" data-placement="top">
                                <i class="glyphicon glyphicon-star"></i>
                            </a>
                            <div class="modal" id="modal_points{{$company->id}}" >
                                <div class="modal-dialog" role="document">
                                    {!! Form::model($company, ['route' => ['companies.update.points', $company->id], 'id'=>'form_point', 'method'=>'PUT']) !!}
                                    {{csrf_field()}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">@lang('app.add_points') </h3></div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <label for="company_id" >@lang('app.category'):</label>
                                                    {{ $company->category->name}}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <label for="company_id" >@lang('app.points'):</label>
                                                    {{ $company->points->sum('sum')}}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="credits">@lang('app.points_add_delete'):</label>
                                                    {!! Form::text('points','',['id' =>'points','name' =>'points', 'class' => 'form-control', 'placeholder'=>trans('app.points_add_delete')]) !!}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="modal-footer">
                                            <input type="submit" id="button_message" data-candidate="" class="btn btn-primary" value="{{trans('app.send')}}" />
                                            <button type="button" class="btn btn-default" data-dismiss="modal">@lang('app.close')</button>
                                        </div>
                                    </div>
                                    {!!form::close()!!}
                                </div>
                            </div>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.view_company')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_company')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('companies.delete', $company->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_company')"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-method="DELETE"
                                    data-confirm-title="@lang('app.please_confirm')'"
                                    data-confirm-text="@lang('app.are_you_sure_delete_company')"
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

    {!! $companies->render() !!}

</div>

@stop


