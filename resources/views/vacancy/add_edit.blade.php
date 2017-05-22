@extends('layouts.app')

@if($edit)
    @section('page-title', trans('app.edit_vacancy'))
@else
    @section('page-title', trans('app.add_vacancy'))
@endif

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $edit ? trans('app.edit_vacancy') : trans('app.create_new_vacancy') }}
            <small>@lang('app.vacancy_details')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('vacancies.index') }}">@lang('app.vacancies')</a></li>
                    <li class="active">{{ $edit ? trans('app.edit') : trans('app.create') }}</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

@if($edit)
    {!! Form::model($vacancy, ['route' => ['vacancies.update', $vacancy->id], 'method' => 'put', 'files' => true, 'id' => 'vacancy-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @include('vacancy.partials.details')
            </div>
        </div>

    {!! Form::close() !!}

@else
    {!! Form::open(['route' => 'vacancies.store', 'files' => true, 'id' => 'vacancy-form']) !!}
        <div class="row">
            <div class="col-md-8">
                @include('vacancy.partials.details', ['edit' => false])
            </div>
        </div>
    {!! Form::close() !!}
@endif

@include ('footer')

@stop

@section('styles')
    {!! HTML::style('assets/css/bootstrap-multiselect.css') !!}
@stop

@section('scripts')
    @if($edit)
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Vacancy\UpdateVacancyRequest', '#vacancy-form') !!}
    @else
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Vacancy\CreateVacancyRequest', '#vacancy-form') !!}
    @endif
    
    {!! HTML::script('assets/js/bootstrap-multiselect.js') !!}

    <script type="text/javascript">
      $(document).ready(function() {
        
        $('.multiselect').multiselect();
      });
    </script>

    <script>
        $('#file').change(function (e) {
            $('#doc_text').val($('#file').val());
        });

        $('.next').click(function (e) {
            if( $('#name').val() != '' &&
                $('#positions_number').val() != '' &&
                $('#career_plan').val() != '' &&
                $('#description').val() != '' &&
                $('#responsabilities').val() != '' &&
                $('#key_points').val() != ''){
                e.preventDefault();
                $('#step-two').click();
            }
        });

        $('.next2').click(function (e) {
            if( $('#experience').val() != '' &&
                $('#key_points').val() != '' &&
                $('#career_plan').val() != '' &&
                $('#address_type_id').val() != '' &&
                $('#address').val() != '' &&
                $('#state').val() != '' &&
                $('#zip_code').val() != ''&&
                $('#city').val() != ''){
                e.preventDefault();
                $('#step-three').click();
            }
        });

        $('.back').click(function () {
            $('#step-one').click();
        });

        $('.back2').click(function () {
            $('#step-two').click();
        });

        $('.save').click(function (e) {            
            if( $('#name').val() == '' ||
                $('#positions_number').val() == '' ||
                $('#career_plan').val() == '' ||
                $('#description').val() == '' ||
                $('#responsabilities').val() == '' ||
                $('#key_points').val() == '')
            {
                e.preventDefault();
                $('#step-one').click();
            }
        });
        
        if( $('#country').val() != ''){
          var country = $('#country').find(':selected').val();
          getStates(country);
        }

        @if( Input::old('state') )
          var country = $('#country').find(':selected').val();
          getStates(country);
        @endif

        $('#country').change(function (e) {
            var country = $('#country').find(':selected').val();
            getStates(country);
        });

        function getStates(country){
            $.get("{{ route('vacancies.getProvince') }}",
              { country: country },
              function(data) {
                if(data){
                  $('#state').empty();
                  $('#state').removeAttr('disabled');
                  $('#state').append($('<option></option>').text('{{ trans('app.select_province') }}').val('')); 
                  $.each(data, function(i) {
                    if("{{ '' }}" == data[i].id ){
                        $('#state').append("<option selected value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }else{
                       $('#state').append("<option value='" + data[i].id + "'>" + data[i].name + "</option>");
                    }
                    
                  });

                  var state = $('#state').find(':selected').val();

                }else{
                  sweetAlert('Oops...'+'{{ trans('app.the_country_has_no_provinces') }}', '{{ trans('app.select_another_country') }}', 'error');
                }
              }, 'json');
        }

        function confirmRegister(country){
            $.get("{{ route('vacancies.getProvince') }}",
              { country: country },
              function(data) {
                if(data){
                    console.log(data);
                }
              }, 'json');
        }
    </script>
@stop
