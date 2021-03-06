@extends('layouts.app')

@section('page-title', trans('app.edit_user'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            {{ $user->present()->nameOrEmail }}
            <small>@lang('app.edit_user_details')</small>
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="javascript:;">@lang('app.home')</a></li>
                    <li><a href="{{ route('user.index') }}">@lang('app.users')</a></li>
                    <li><a href="{{ route('user.show', $user->id) }}">{{ $user->present()->nameOrEmail }}</a></li>
                    <li class="active">@lang('app.edit')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active" id="validate-one">
        <a class="validate" href="#details" aria-controls="details" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.contact_informations')
        </a>
    </li>
    <li role="presentation" class="additional" id="validate-dos">
        <a class="validate" href="#company_information" aria-controls="company_information" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.company_information')
        </a>
    </li>
    <li role="presentation" class="additional" id="validate-select">
        <a class="validate" href="#especialization" aria-controls="especialization" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.especialization')
        </a>
    </li>
    <li role="presentation">
        <a class="validate" href="#auth" aria-controls="auth" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.notifications')
        </a>
    </li>
    <li role="presentation" class="additional">
        <a class="validate" href="#last_step" aria-controls="last_step" role="tab" data-toggle="tab">
            <i class="glyphicon glyphicon-th"></i>
            @lang('app.last_step')
        </a>
    </li>
</ul>
<!-- Tab panes -->
{!! Form::open(['route' => ['user.update.all', $user->id], 'method' => 'PUT', 'id' => 'login-details-form']) !!}
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="details">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @include('user.partials.details', ['user_details' => false])
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="company_information">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @include('user.partials.company_information')
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="especialization">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @include('user.partials.especialization')
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="auth">
        <div class="row">
            <div class="col-md-8">
                @include('user.partials.notifications')
            </div>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="last_step">
        <div class="row">
            <div class="col-md-8">
                @include('user.partials.last_step')
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@stop

@section('styles')
    {!! HTML::style('assets/css/bootstrap-datetimepicker.min.css') !!}
    {!! HTML::style('assets/plugins/croppie/croppie.css') !!}
@stop

@section('scripts')
    {!! HTML::script('assets/plugins/croppie/croppie.js') !!}
    {!! HTML::script('assets/js/moment.min.js') !!}
    {!! HTML::script('assets/js/bootstrap-datetimepicker.min.js') !!}
    {!! HTML::script('assets/js/as/btn.js') !!}
    {!! HTML::script('assets/js/as/profile.js') !!}

    <script>
        $(document).ready(function() {
            $('#phone').change(function(){
                $('#phone1').val($('#phone').intlTelInput("getNumber"));
            });

            $("#phone").on("countrychange", function(e, countryData) {
                $('#phone1').val($('#phone').intlTelInput("getNumber"));
            });

            $('#secundary_phone').change(function(){
                $('#phone2').val($('#secundary_phone').intlTelInput("getNumber"));
            });

            $("#secundary_phone").on("countrychange", function(e, countryData) {
                $('#phone2').val($('#secundary_phone').intlTelInput("getNumber"));
            });

            @if($user->roles->first()->id==5 || $user->roles->first()->id==6)
                $('.additional').show();
                $('.additional2').hide();
            @else
                $('.additional').hide();
                $('.additional2').show();
            @endif
            $('#role').change(function(){
                if($(this).val()==5 || $(this).val()==6){
                    $('.additional').show();
                    $('.additional2').hide();
                } else {
                    $('.additional').hide();
                    $('.additional2').show();
                }
            });

            $('#promotional_code_item').hide();

            $("#test1").on( "click", function() {
                $('#promotional_code_item').show("slow");
            });

            $("#test2").on( "click", function() {
                $('#promotional_code_item').hide("slow");
                $('#promotional_code').val("");
            });

            @if(($preferences!='') && $preferences->reference!='')
                    $('#reference_item').show();
            @else
                    $('#reference_item').hide();
            @endif

            @if(($profile!='') && $profile->reference_job!='')
                $('#reference_job_title').show();
            @else
                $('#reference_job_title').hide();
            @endif


                $('#contact_id').change(function () {
                if($(this).val() == 1 || $(this).val() == 4 || $(this).val() == 5){
                    $('#reference_item').show("slow");
                } else {
                    $('#reference_item').hide("slow");
                    $('#reference').val("");
                }
            });

            $('#job_title_id').change(function () {
                if($(this).val() == 8){
                    $('#reference_job_title').show("slow");
                } else {
                    $('#reference_job_title').hide("slow");
                    $('#reference_job').val("");
                }
            });

            industries = new Array();
            opportunityShare = new Array();
            opportunityInvolved = new Array();
            searchType = new Array();
            searchTypeWork = new Array();
            locat = new Array();
            $('.subopciones-select li').click(function () {
                $('#validate-especialization').remove();
                if ($(this).parent().hasClass('industries')) {
                    if ($(this).find('a').hasClass('active-option')) {
                        industries.push($(this).attr('value'));
                    } else {
                        industries = industries.toString();
                        industries = industries.replace(',' + $(this).attr('value'), '');
                        industries = industries.replace($(this).attr('value') + ',', '');
                        industries = industries.replace($(this).attr('value'), '');
                        if (industries != '') {
                            industries = industries.split(',');
                        } else {
                            industries = new Array();
                        }
                    }
                    console.log(industries);
                    $('#industries').val(industries.toString());
                }
                if ($(this).parent().hasClass('opportunityShare')) {
                    if ($(this).find('a').hasClass('active-option')) {
                        opportunityShare.push($(this).attr('value'));
                    } else {
                        opportunityShare = opportunityShare.toString();
                        opportunityShare = opportunityShare.replace(',' + $(this).attr('value'), '');
                        opportunityShare = opportunityShare.replace($(this).attr('value') + ',', '');
                        opportunityShare = opportunityShare.replace($(this).attr('value'), '');
                        if (opportunityShare != '') {
                            opportunityShare = opportunityShare.split(',');
                        } else {
                            opportunityShare = new Array();
                        }
                    }
                    console.log(opportunityShare);
                    $('#opportunityShare').val(opportunityShare.toString());
                }
                if ($(this).parent().hasClass('opportunityInvolved')) {
                    if ($(this).find('a').hasClass('active-option')) {
                        opportunityInvolved.push($(this).attr('value'));
                    } else {
                        opportunityInvolved = opportunityInvolved.toString();
                        opportunityInvolved = opportunityInvolved.replace(',' + $(this).attr('value'), '');
                        opportunityInvolved = opportunityInvolved.replace($(this).attr('value') + ',', '');
                        opportunityInvolved = opportunityInvolved.replace($(this).attr('value'), '');
                        if (opportunityInvolved != '') {
                            opportunityInvolved = opportunityInvolved.split(',');
                        } else {
                            opportunityInvolved = new Array();
                        }
                    }
                    console.log(opportunityInvolved);
                    $('#opportunityInvolved').val(opportunityInvolved.toString());
                }
                if ($(this).parent().hasClass('searchType')) {
                    if ($(this).find('a').hasClass('active-option')) {
                        searchType.push($(this).attr('value'));
                    } else {
                        searchType = searchType.toString();
                        searchType = searchType.replace(',' + $(this).attr('value'), '');
                        searchType = searchType.replace($(this).attr('value') + ',', '');
                        searchType = searchType.replace($(this).attr('value'), '');
                        if (searchType != '') {
                            searchType = searchType.split(',');
                        } else {
                            searchType = new Array();
                        }
                    }
                    console.log(searchType);
                    $('#searchType').val(searchType.toString());
                }
                if ($(this).parent().hasClass('searchTypeWork')) {
                    if ($(this).find('a').hasClass('active-option')) {
                        searchTypeWork.push($(this).attr('value'));
                    } else {
                        searchTypeWork = searchTypeWork.toString();
                        searchTypeWork = searchTypeWork.replace(',' + $(this).attr('value'), '');
                        searchTypeWork = searchTypeWork.replace($(this).attr('value') + ',', '');
                        searchTypeWork = searchTypeWork.replace($(this).attr('value'), '');
                        if (searchTypeWork != '') {
                            searchTypeWork = searchTypeWork.split(',');
                        } else {
                            searchTypeWork = new Array();
                        }
                    }
                    console.log(searchTypeWork);
                    $('#searchTypeWork').val(searchTypeWork.toString());
                }
                if ($(this).parent().hasClass('location')) {
                    if ($(this).find('a').hasClass('active-option')) {
                        locat.push($(this).attr('value'));
                    } else {
                        locat = locat.toString();
                        locat = locat.replace(',' + $(this).attr('value'), '');
                        locat = locat.replace($(this).attr('value') + ',', '');
                        locat = locat.replace($(this).attr('value'), '');
                        if (locat != '') {
                            locat = locat.split(',');
                        } else {
                            locat = new Array();
                        }
                    }
                    console.log(locat);
                    $('#location').val(locat.toString());
                }
            });
            /*
             $('#validate-select').click(function(e){
             var validate = false;
             $('.categoria-container-item ul li a').each(function(){
             if($(this).hasClass('active-option')){
             validate = true;
             }
             });
             if(!validate){
             e.preventDefault();
             e.stopPropagation();
             if(!document.getElementById('validate-especialization')){
             $('.categoria-container-item').parent().append('<p id="validate-especialization" class="text-darger" style="color:red; text-align: right; font-style: italic;">{{trans("app.you_must_select_a_specialization")}}</p>');
             }
             }
             });*/

            $('.validate').click(function (e) {
                validar = '';
                $('.nav-tabs li').each(function(){
                    if($(this).hasClass('active')){
                        validar = $(this).attr('id');
                    }
                });
                if(validar==''){
                    return true;
                }
                var validate = false;
                var vala = validar;
                $('.' + vala + '-input .' + vala).each(function () {
                    if ($(this).val() == '') {
                        validate = true;
                        var papa = $(this).parent();
                        if (!papa.hasClass('form-group')) {
                            papa = papa.parent();
                        }
                        if (!papa.find('.error-help-block').attr('class')) {
                            papa.append('<span id="first_name-error" class="help-block error-help-block">' + $(this).attr('message') + '</span>');
                            papa.addClass('has-error');
                            $(this).change(function () {
                                var papa = $(this).parent();
                                if (!papa.hasClass('form-group')) {
                                    papa = papa.parent();
                                }
                                papa.removeClass('has-error');
                                if ($(this).val() != '') {
                                    papa.find('.error-help-block').html('');
                                } else {
                                    papa.addClass('has-error');
                                    papa.find('.error-help-block').html($(this).attr('message'));
                                }
                            });
                            $(this).keyup(function () {
                                var papa = $(this).parent();
                                if (!papa.hasClass('form-group')) {
                                    papa = papa.parent();
                                }
                                papa.removeClass('has-error');
                                if ($(this).val() != '') {
                                    papa.find('.error-help-block').html('');
                                } else {
                                    papa.addClass('has-error');
                                    papa.find('.error-help-block').html($(this).attr('message'));
                                }
                            });
                        }
                    }
                });
                if (validate) {
                    $(this).addClass('error-form');
                    e.preventDefault();
                    e.stopPropagation();
                } else {
                    $(this).removeClass('error-form');
                }
            });

            @if(isset($address) && $address!='' && $address->country_id!='')
$.ajax({
                method: "GET",
                url: "{{route('country.getProvince')}}?country={{$address->country_id}}",
                success: function(response){
                    var html = '<option value="">{{trans('app.choose_province')}}</option>';
                    for(var i = 0; i<response.length; i++){
                        html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                    }
                    $('#state_id2').html(html);
                    $('#state_id2').attr('disabled', false);
                    @if($address!='' && $address->state_id!='')
                      $('#state_id2').val("{{$address->state_id}}");
                    $.ajax({
                        method: "GET",
                        url: "{{route('country.getCities')}}?state={{$address->state_id}}",
                        success: function(response){
                            var html = '<option value="">{{trans('app.choose_city')}}</option>';
                            for(var i = 0; i<response.length; i++){
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#city_id2').html(html);
                            $('#city_id2').attr('disabled', false);
                            $('#city_id2').val("{{$address->city_id}}");
                        }
                    });
                    @endif
                }
            });
            @endif

          $('#country_id2').change(function(){
                if($(this).val()!=''){
                    var country = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "{{route('country.getProvince')}}?country="+country,
                        success: function(response){
                            var html = '<option value="">{{trans('app.choose_province')}}</option>';
                            for(var i = 0; i<response.length; i++){
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#state_id2').html(html);
                            $('#state_id2').attr('disabled', false);
                        }
                    });
                } else {
                    $('#state_id2').val('');
                    $('#city_id2').val('');
                    $('#state_id2').attr('disabled', true);
                    $('#city_id2').attr('disabled', true);
                }
            });

            $('#state_id2').change(function(){
                if($(this).val()!=''){
                    var state = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "{{route('country.getCities')}}?state="+state,
                        success: function(response){
                            var html = '<option value="">{{trans('app.choose_city')}}</option>';
                            for(var i = 0; i<response.length; i++){
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#city_id2').html(html);
                            $('#city_id2').attr('disabled', false);
                        }
                    });
                } else {
                    $('#city_id2').val('');
                    $('#city_id2').attr('disabled', true);
                }
            });
        });
    </script>
@stop