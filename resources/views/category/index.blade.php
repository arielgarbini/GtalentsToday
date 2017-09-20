@extends('layouts.app')

@section('page-title', trans('app.categories'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.categories')
            <small>@lang('app.list_of_registered_categories')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.categories')</li>
                </ol>
            </div>

        </h1>
    </div>
</div>
<div></div>
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success" id="add-category">
            <i class="glyphicon glyphicon-plus"></i>
            @lang('app.add_category')
        </a>
    </div>
    <div class="col-md-5"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="categories-form">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_categories')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-categories-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('categories.index') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive top-border-table" id="categories-table-wrapper">
    <table class="table">
        <thead>
            <th>#</th>
            <th>@lang('app.name')</th>
            <th>@lang('app.status')</th>
            <th class="text-center">@lang('app.action')</th>
        </thead>
        <tbody>
            @if (count($categories))
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id  }}</td>
                        <td>{{ $category->name  }}</td>
                        @if($category->is_active)
                            <td><span class="label label-success">{{ trans('app.active') }}</span></td>
                        @else
                            <td><span class="label label-danger">{{ trans('app.inactive') }}</span></td>
                        @endif
                        <td class="text-center">
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.view_category')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_category')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('categories.delete', $category->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_category')"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-method="DELETE"
                                    data-confirm-title="@lang('app.please_confirm')'"
                                    data-confirm-text="@lang('app.are_you_sure_delete_category')"
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

    {!! $categories->render() !!}

</div>

@stop


