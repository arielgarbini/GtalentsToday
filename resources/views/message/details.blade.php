@extends('layouts.app')

@section('page-title', trans('app.messages'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{$message->subject}}
            <small>{{strftime("%d/%b/%Y",strtotime($message->created_at)) }}</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li class="active">@lang('app.messages')</li>
                </ol>
            </div>

        </h1>
    </div>
</div>

@include('partials.messages')


   <div class="row">
    <h3> <b> {{$message->sender->first_name}} </b> </h3>   
     <br><br>  {{ $message->message}}  
   </div><br><br><br>

    <div class="col-md-12">
        <a href="{{route('messages.index')}}"><button type="button" class="btn btn-primary">
            <i class="fa fa-arrow-left "></i>
            @lang('app.back')
        </button></a>
    </div>
    
@stop