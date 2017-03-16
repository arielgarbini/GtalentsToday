@extends('layouts.app')

@section('page-title', trans('app.messages'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.messages')
            <small>@lang('app.received')</small>
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

<div class="row tab-search">
     <div class="col-md-2">
        <a href="" class="open-Modal btn btn-success" id="btn_message" data-id="" data-toggle="modal" data-target="#modal_message" data-whatever="@getbootstrap">
            <i class="fa fa-cogs fa-envelope"></i>
            @lang('app.add_message')
        </a>
    </div>
    <div class="col-md-2">
        {!! Form::select('status',['1' => 'Leídos','2' => 'No Leídos', '3' => 'Todos'],null, ['id' => 'status', 'class' => 'form-control']) !!}  
    </div>
     <div class="col-md-5"> 
      <a href="" class="btn btn-danger btn-circle" title="@lang('app.delete_user')"
                data-toggle="tooltip"
                data-placement="top"
                data-method="DELETE"
                data-confirm-title="@lang('app.please_confirm')"
                data-confirm-text="@lang('app.are_you_sure_delete_user')"
                data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="glyphicon glyphicon-trash"></i>
        </a>  
    </div>
    <form method="GET" action="" accept-charset="UTF-8" id="messages-form">
    
        <div class="col-md-3">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" value="{{ Input::get('search') }}" placeholder="@lang('app.search_for_messages')">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="search-messages-btn">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                    @if (Input::has('search') && Input::get('search') != '')
                        <a href="{{ route('message.list') }}" class="btn btn-danger" type="button" >
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </form>
</div>

<div class="table-responsive top-border-table" id="messages-table-wrapper">
   <div class="col-md-2">
    <thead>
            <th>Todos los Mensajes</th>
    </thead>        
    <table class="table">
        <tbody>
            <tr>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>      
   </div> 
    <div class="col-md-10">
    <table class="table">
        <thead>
            <th>#</th>
            <th>@lang('app.user')</th>
            <th>@lang('app.subject')</th>
            <th>@lang('app.message')</th>
            <th class="text-center">@lang('app.date')</th>
            <th>@lang('app.action')</th>
        </thead>
        <tbody>
            @if (count($messages))
                @foreach ($messages as $message)
                   <tr style="cursor:pointer">
                        <td><input type="checkbox" id="message_id"> </td>
                        <td>{{ $message->sender->first_name }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>{{ $message->message }}</td>
                        <td class="text-center">{{strftime("%d/%b/%Y",strtotime($message->created_at)) }}</td>
                        <td><a href="{{ route ('messages.details', $message->id) }}"> @lang('app.view_details') </a></td>
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
</div>
                   
<!-- ......................Modal Mensaje ......................... -->              
                  
<div class="modal" id="modal_message" >  
    <div class="modal-dialog" role="document">
        {!! Form::open(['route' => 'messages.store','id'=>'form_message']) !!}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-title textoFormulario" id="exampleModalLabel"><h3 class="titulillo">Enviar Mensaje </h3></div>
            </div>
           
            <div class="modal-body">
                {!! Form::hidden('sender_user_id', Auth::user()->id, ['name'=>'sender_user_id']) !!} 
                <div class="row">
                    <div class="col-md-12" >
                        <label for="email" >Destinatario:</label>
                        {!! Form::select('destinatary_user_id',$users,null,['id' =>'destinatary_user_id', 'name' =>'destinatary_user_id', 'class' => 'form-control']) !!}  
                    </div>
                </div>   
                <br> 
                <div class="row">
                    <div class="col-md-12" >
                        <label  for="asunto">Asunto:</label>
                        {!! Form::text('subject',null,['id' =>'subject','name' =>'subject', 'class' => 'form-control', 'placeholder'=>'Asunto']) !!}  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12" >
                        <label for="mensaje">Mensaje:</label>
                        {!! Form::textarea('message',null,['id' =>'message','name' =>'message', 'class' => 'form-control', 'placeholder'=>'mensaje']) !!}  
                    </div>
                </div>
            </div> 
            <br>
            <div class="modal-footer">
                <input type="submit" id="button_message" data-candidate="" class="btn btn-primary" value="Enviar" />
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div> 
        </div>
        {!!form::close()!!} 
    </div>
</div>

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#messages-form").submit();
        });
    
        function details_message(){
            alert('Para mostrar detalle mensajes');
        }
    </script>

    {!! HTML::script('assets/js/modal_message.js') !!}


@stop
