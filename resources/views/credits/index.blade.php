@extends('layouts.app')

@section('page-title', trans('app.invoices'))

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @lang('app.credits')
                <small>@lang('app.list_of_registered_credits')</small>
                <div class="pull-right">
                    <ol class="breadcrumb">
                        <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                        <li class="active">@lang('app.credits')</li>
                    </ol>
                </div>

            </h1>
        </div>
    </div>
    <div></div>
    @include('partials.messages')

    <div class="row tab-search">
        <div class="col-md-9">
            <a href="" class="open-Modal btn btn-success" data-id="" data-toggle="modal" data-target="#modal_credit" id="add-credit">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.add_credits')
            </a>
            <a href="" class="open-Modal btn btn-success" data-id="" data-toggle="modal" data-target="#modal_credit8" id="back-credit-price">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.credits_back')
            </a>
            <a href="" class="open-Modal btn btn-info" data-id="" data-toggle="modal" data-target="#modal_credit2" id="add-credit-price">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.change_credits_price')
            </a>
            <a href="" class="open-Modal btn btn-info" data-id="" data-toggle="modal" data-target="#modal_credit9" id="candidate-credit-price">
                <i class="glyphicon glyphicon-plus"></i>
                @lang('app.change_credits_price_candidate')
            </a>
        </div>
        <div class="col-md-3">
            <form method="GET" action="" accept-charset="UTF-8" id="credits-form">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_companies')">
                        <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-vacancies-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                            @if (Input::has('search') && Input::get('search') != '')
                                <a href="{{ route('credits.list') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                            @endif
                </span>
                    </div>
            </form>
        </div>
    </div>
    <strong>@lang('app.price_per_credit')</strong> {{$last_credit->value}}$<br>
    <strong>@lang('app.credits_for_candidate')</strong> {{$candidate_price->value}}
    <div class="table-responsive top-border-table" id="vacancies-table-wrapper">
        <table class="table">
            <thead>
            <th>@lang('app.company')</th>
            <th>@lang('app.credits')</th>
            <th>@lang('app.date')</th>
            <th>@lang('app.status')</th>
            <th class="text-center">@lang('app.action')</th>
            </thead>
            <tbody>
            @if (count($credits))
                @foreach ($credits as $inv)
                    <tr>
                        <td>{{$inv->company->name}}</td>
                        <td>
                            {{number_format($inv->credit, 0, ',', '.')}}
                        </td>
                        <td>{{$inv->created_at->format('Y-m-d')}}</td>
                        <td>
                            @if($inv->status==1)
                                <span class="label label-success">
                                    @lang('app.credits_purchase')
                                </span>
                            @elseif($inv->status==2)
                                <span class="label label-success">
                                @lang('app.credits_back')
                            </span>
                            @elseif($inv->status==3)
                                <span class="label label-warning">
                                    @lang('app.credits_use')
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="" data-id="" data-toggle="modal" data-target="#modal_credit3-{{$inv->id}}" id="add-credit-price" class="open-Modal btn btn-primary btn-circle edit" title="@lang('app.edit_credits')">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            <div class="modal" id="modal_credit3-{{$inv->id}}" >
                                <div class="modal-dialog" role="document">
                                    {!! Form::model($inv, ['route' => ['credits.update',$inv->id],'id'=>'form_credit3', 'method' => 'PUT']) !!}
                                    {{csrf_field()}}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">@lang('app.edit_credits') </h3></div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <label for="company_id" >@lang('app.company'):</label>
                                                    {!! Form::text('company_id',$inv->company->name,['readonly' => 'readonly', 'id' =>'company_id', 'name' =>'company_id', 'class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12" >
                                                    <label for="credits">@lang('app.credits'):</label>
                                                    {!! Form::text('credits',$inv->credit,['id' =>'credits','name' =>'credits', 'class' => 'form-control', 'placeholder'=>trans('app.credits')]) !!}
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
                            <a href="{{ route('credits.delete', $inv->id) }}" class="btn btn-danger btn-circle" title="@lang('app.delete_invoice')"
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

    <div class="modal" id="modal_credit" >
        <div class="modal-dialog" role="document">
            {!! Form::open(['route' => 'credits.store','id'=>'form_credit']) !!}
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">@lang('app.add_credits') </h3></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <label for="company_id" >@lang('app.company'):</label>
                            {!! Form::select('company_id',$companies,null,['id' =>'company_id', 'name' =>'company_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12" >
                            <label for="credits">@lang('app.credits'):</label>
                            {!! Form::text('credits',null,['id' =>'credits','name' =>'credits', 'class' => 'form-control', 'placeholder'=>trans('app.credits')]) !!}
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

    <div class="modal" id="modal_credit2" >
        <div class="modal-dialog" role="document">
            {!! Form::open(['route' => 'credits.store.price','id'=>'form_credit_price']) !!}
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">@lang('app.add_credits') </h3></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <label for="credits">@lang('app.new_price_credits'):</label>
                            {!! Form::text('credits',null,['id' =>'credits','name' =>'credits', 'class' => 'form-control', 'placeholder'=>trans('app.new_price_credits')]) !!}
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

    <div class="modal" id="modal_credit9" >
        <div class="modal-dialog" role="document">
            {!! Form::open(['route' => 'credits.store.price.candidate','id'=>'form_credit_price']) !!}
            {{csrf_field()}}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">@lang('app.change_credits_price') </h3></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <label for="credits">@lang('app.new_price_credits_candidates'):</label>
                            {!! Form::text('credits',null,['id' =>'credits','name' =>'credits', 'class' => 'form-control', 'placeholder'=>trans('app.new_price_credits')]) !!}
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

    <div class="modal" id="modal_credit8" >
        <div class="modal-dialog" role="document">
            {!! Form::open(['route' => ['credits.store'],'id'=>'form_credit8', 'method' => 'POST']) !!}
            {{csrf_field()}}
            <input type="hidden" name="status" value="2">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">@lang('app.credits_back') </h3></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" >
                            <label for="company_id" >@lang('app.company'):</label>
                            {!! Form::select('company_id',$companies,null,['id' =>'company_id', 'name' =>'company_id', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12" >
                            <label for="credits">@lang('app.credits'):</label>
                            {!! Form::text('credits',null,['id' =>'credits','name' =>'credits', 'class' => 'form-control', 'placeholder'=>trans('app.credits')]) !!}
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
@stop
