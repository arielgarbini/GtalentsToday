@extends('layouts.app')

@if($edit)
    @section('page-title', trans('app.edit_invoice'))
@else
    @section('page-title', trans('app.add_invoice'))
@endif

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                {{ $edit ? trans('app.edit_invoice') : trans('app.create_new_invoice') }}
                <small>@lang('app.invoice_details')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li><a href="{{ route('invoices.index') }}">@lang('app.invoices')</a></li>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    {!! HTML::style('assets/plugins/croppie/croppie.css') !!}
    {!! HTML::style('assets/css/bootstrap-multiselect.css') !!}
@stop

@section('scripts')
        {!! HTML::script('assets/js/moment.min.js') !!}
        <script type="application/javascript" src="    https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

    <script>
        var today = new Date();
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            endDate: today.getFullYear()+'-'+today.getMonth()+1+'-'+today.getDate()
        });

        $('.datepickerr').datepicker({
            format: 'yyyy-mm-dd'
        });
    </script>
@stop