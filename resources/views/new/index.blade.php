@extends('layouts.app')

@section('page-title', trans('app.news'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.news')
            <small>@lang('app.list_of_registered_news')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.news')</li>
                </ol>
            </div>

        </h1>
    </div>
</div>
<div></div>
@include('partials.messages')

<div class="row tab-search">
    <div class="col-md-2">
        <a href="{{ route('news.create') }}" class="btn btn-success" id="add-new">
            <i class="glyphicon glyphicon-plus"></i>
            @lang('app.add_new')
        </a>
    </div>
    <div class="col-md-5"></div>
    <form method="GET" action="" accept-charset="UTF-8" id="news-form">
        <div class="col-md-2">
        </div>
        <div class="col-md-3">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_news')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-news-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('news.index') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive top-border-table" id="news-table-wrapper">
    <table class="table">
        <thead>
            <th>@lang('app.title')</th>
            <th>@lang('app.description')</th>
            <th>@lang('app.section')</th>
            <th class="text-center">@lang('app.action')</th>
        </thead>
        <tbody>
            @if (count($news))
                @foreach ($news as $new)
                    <tr>
                        <td>{{ $new->title }}</td>
                        <td width="600px">{{ $new->description }}</td>
                        <td>{{ $new->section }}</td>
                        <td class="text-center">
                            <a href="{{ route('news.show', $new->id) }}" class="btn btn-success btn-circle"
                               title="@lang('app.view_new')" data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </a>
                            <a href="{{ route('news.edit', $new) }}" class="btn btn-primary btn-circle edit" title="@lang('app.edit_new')"
                                    data-toggle="tooltip" data-placement="top">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <a href="{{ route('news.delete', $new->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_new')"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-method="DELETE"
                                    data-confirm-title="@lang('app.please_confirm')'"
                                    data-confirm-text="@lang('app.are_you_sure_delete_new')"
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

    {!! $news->render() !!}

</div>

@stop
