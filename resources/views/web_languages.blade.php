@extends('layouts.app')

@section('page-title', trans('app.languages'))

@section('content')

@include('partials.messages')
</br></br>
    <nav class="navbar navbar-default container">
      <div class="container-fluid">
      <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ url('lang', ['en']) }}">En</a></li>
            <li><a href="{{ url('lang', ['es']) }}">Es</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="jumbotron container">
        <p>{{ trans('sector.Security and Investigations') }}</p>
        <p>{{ trans('sector.Semiconductors') }}</p>
        <p>{{ trans('sector.Shipbuilding') }}</p>
        <p>{{ trans('sector.Sporting Goods') }}</p>      
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

@stop