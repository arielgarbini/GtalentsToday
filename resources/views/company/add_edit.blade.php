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
        <!--
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
        </li>-->
    @endif
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">

    @if($edit)

        {!! Form::model($company, ['route' => ['companies.update', $company->id], 'method' => 'put', 'files' => true, 'id' => 'company-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @include('company.partials.details')
                </div>
            </div>
        {!! Form::close() !!}
    @else
        {!! Form::open(['route' => 'companies.store', 'files' => true, 'id' => 'company-form']) !!}
            <div class="row">
                <div class="col-md-8">
                    @include('company.partials.details', ['edit' => false])
                </div>
            </div>
        {!! Form::close() !!}
    @endif

    </div>
    @if( Auth::user()->hasRole('AdminConsultant'))
        <div role="tabpanel" class="tab-pane" id="profile">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    {!! Form::open(['route' => 'companies.profile.update', 'method' => 'PUT', 'id' => 'profile-form']) !!}
                        @include('company.partials.edit_profile', ['profile' => true])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="experience">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    {!! Form::open(['route' => 'companies.experience.update', 'method' => 'PUT', 'id' => 'experience-form']) !!}
                        @include('company.partials.edit_experience', ['experience' => true])
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif

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
                    if("{{ $edit && $company->address->state ? $company->address->state->id: '' }}" == data[i].id ){
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
    </script>
@stop