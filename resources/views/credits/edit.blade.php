@extends('layouts.app')

@if($edit)
    @section('page-title', trans('app.edit_company'))
@else
    @section('page-title', trans('app.add_company'))
@endif

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $edit ? trans('app.edit_company') : trans('app.create_new_company') }}
                <small>@lang('app.company_details')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li><a href="{{ route('companies.index') }}">@lang('app.companies')</a></li>
                        <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                    </ol>
                </div>
            </h1>
        </div>
    </div>

    @include('partials.messages')

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#details" aria-controls="details" role="tab" data-toggle="tab">
                <i class="glyphicon glyphicon-th"></i>
                @lang('app.details')
            </a>
        </li>
        @if($edit)
            <li role="presentation">
                <a href="#profile" aria-controls="auth" role="tab" data-toggle="tab">
                    <i class="fa fa-lock"></i>
                    @lang('app.profile')
                </a>
            </li>
            <li role="presentation">
                <a href="#experience" aria-controls="auth" role="tab" data-toggle="tab">
                    <i class="fa fa-lock"></i>
                    @lang('app.experience')
                </a>
            </li>
        @endif
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="details">

            @if($edit)
                {!! Form::model($invoice, ['route' => ['invoices.update', $invoice->id], 'method' => 'put', 'files' => true, 'id' => 'invoice-form']) !!}
                <div class="row">
                    <div class="col-md-8">
                        @include('invoices.partials.details')
                    </div>
                </div>
                {!! Form::close() !!}
            @endif

        </div>
    </div>


    @include ('footer')

@stop

@section('styles')
    {!! HTML::style('assets/css/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('assets/plugins/croppie/croppie.css') !!}
    {!! HTML::style('assets/css/bootstrap-multiselect.css') !!}
@stop

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.multiselect').multiselect();
        });
    </script>

    @if($edit)

        {!! HTML::script('assets/js/bootstrap-multiselect.js') !!}

        {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyProfileRequest', '#profile-form') !!}
        {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyExperienceRequest', '#experience-form') !!}

        {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\UpdateCompanyRequest', '#company-form') !!}
    @else
        {!! JsValidator::formRequest('Vanguard\Http\Requests\Company\CreateCompanyRequest', '#company-form') !!}
    @endif

    <script>

    </script>
@stop