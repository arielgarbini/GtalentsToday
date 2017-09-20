@extends('layouts.app')

@if($edit)
    @section('page-title', trans('app.edit_category'))
@else
    @section('page-title', trans('app.add_category'))
@endif

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? trans('app.edit_category') : trans('app.create_new_category') }}
            <small>@lang('app.category_details')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('categories.index') }}">@lang('app.categories')</a></li>
                    <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

@if($edit)
        <div class="row">
            <div class="col-lg-8 col-md-8">
                {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'put', 'files' => true, 'id' => 'category-form']) !!}
                    @include('category.partials.details', ['profile' => false])
                {!! Form::close() !!}
            </div>
            <div class="col-lg-4 col-md-4">
                {!! Form::open(['route' => ['categories.update.avatar',$category], 'files' => true, 'id' => 'avatar-form']) !!}
                    @include('category.partials.avatar', ['updateUrl' => route('categories.update.avatar-external',$category)])
                {!! Form::close() !!}
            </div>
        </div>
    

@else
    {!! Form::open(['route' => 'categories.store', 'files' => true, 'id' => 'category-form']) !!}
        <div class="row">
            <div class="col-lg-8 col-md-8">
                @include('category.partials.details', ['edit' => false, 'profile' => false])
            </div>
            <div class="col-lg-4 col-md-4">
                    @include('category.partials.avatar')
            </div>
        </div>
    {!! Form::close() !!}
@endif

@stop

@section('styles')
    {!! HTML::style('assets/plugins/croppie/croppie.css') !!}
@stop

@section('scripts')

    {!! HTML::script('assets/plugins/croppie/croppie.js') !!}
    {!! HTML::script('assets/js/moment.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('assets/js/as/btn.js') !!}
    {!! HTML::script('assets/js/as/profile.js') !!}

    @if($edit)
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Category\UpdateCategoryRequest', '#category-form') !!}
    @else
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Category\CreateCategoryRequest', '#category-form') !!}
    @endif
@stop
