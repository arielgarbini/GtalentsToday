@extends('layouts.app')

@section('page-title', trans('app.add_vacancy'))

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            @lang('app.vacancy_details')
            <div class="pull-right">
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">@lang('app.home')</a></li>
                    <li><a href="{{ route('vacancies.index') }}">@lang('app.vacancies')</a></li>
                    <li class="active">@lang('app.show')</li>
                </ol>
            </div>
        </h1>
    </div>
</div>

@include('partials.messages')

<div class="row">
    <div class="col-lg-8 col-md-8">
        <div class="panel panel-default">
            <div class="panel-body">
                <span class="pull-right small">
                    @lang('app.published'): {{ $vacancy->created_at->diffForHumans() }}
                    @if($vacancy->poster_user_id == Auth::user()->id)
                        <a href="{{ route('vacancies.edit', $vacancy->id) }}" title="@lang('app.edit')">
                            <i class="fa fa-pencil fa-fw"></i>
                        </a>
                    @endif
                </span>
                <h3>{{ $vacancy->name }}</h3>
                <caption>{{ $vacancy->location }}</caption>
                <hr />
                <h4>@lang('app.description')</h4>
                <p>{{$vacancy->target_companies}}</p>
                <br />
                <h4>@lang('app.experience')</h4>
                <p>{{$vacancy->required_experience}}</p>
                <br />
                <h4>@lang('app.responsabilities')</h4>
                <p>{{ $vacancy->responsabilities }}</p>
                <br />
                <!--HORARIO DE TRABAJO-->
                <h4>{{trans('app.working_hours')}}</h4>
                <p><span style="color:red"></span></p>
                <br />
                 <!--TIPO DE CONTRATACION-->
                <h4>{{trans('app.contract_type')}}</h4>
                <p>{{$vacancy->contract_type->name}}</p>
                <br />
                <!--ESPECIALIZACION-->
                <h4>{{trans('app.especialization')}}</h4>
                <p>Diseño, Programación Frontend.</p>
                <br />
                <!--AÑOS DE EXPERIENCIA-->
                <h4>{{trans('app.experience_years')}}</h4>
                <p>{{$vacancy->years_experience}}</p>
                <br />
                 <!--HONORARIO COBRADO AL EMPLEADOR-->
                <h4>Honorario cobrado al empleador</h4>
                <p>23% - Fijo.</p>
                <br />
                <!--PERIODO DE REEMPLAZO-->
                <h4>{{trans('app.replacement_period')}}</h4>
                <p>{{$vacancy->replacement_period}}</p>
                <br />

                @if(count($vacancy->languages))
                    <h4>@lang('app.languages_required')</h4>
                    @foreach($vacancy->languages as $lang)
                        <p>{{ $lang->name }}</p>
                    @endforeach
                    <br />
                @endif

                @if($vacancy->range_salary)
               <h4> {{  trans('app.range_salary')}} : {{ $vacancy->range_salary }}</h4>
                @endif
                <br />
                {{  trans('app.location') }}: {{ $vacancy->location }}
                </p><br />

                    <div class="col-md-12">
                        <div class="col-md-6">
                        <!--LINK DESCARGA-->
                            <div class="link">
                                <a href="#">
                                    <figure>
                                        <span class="icon-gTalents_pdf"></span>
                                    </figure>
                                    <p>Descripción del puesto</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                        <!--LINK DESCARGA-->
                            <div class="link">
                                <a href="#">
                                    <figure>
                                        <span class="icon-gTalents_pdf"></span>
                                    </figure>
                                    <p>Acuerdo del Empleado</p>
                                </a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4">

        @if(!Auth::user()->hasRole('Admin') And Auth::user()->id != $vacancy->poster_user_id )
            <a href="{{route('vacancies.apply', $vacancy->id)}}" class="btn btn-success" style="width:100%;">
                @lang('app.interested')
            </a>
            <br />
            <br />
        @endif

        <p>{{trans('app.status')}}:  <span class="label label-{{ $vacancy->vacancy_status_id == 1 ? 'success':'warning' }}">
            {{ $vacancy->vacancy_status->getNameLang($vacancy->vacancy_status_id)->name }}
        </span></p>

        @if (($vacancy->vacancy_status_id== 2 ) || ($vacancy->vacancy_status_id==6))
        <a href="{{route('vacancies.vacancy_status', $vacancy->id)}}">
            <button type="button" class="btn btn-primary" style="width:100%;">
            @lang('app.approve')
            </button>
        </a>
        @endif
        <br /> <br />

        <!--<div class="panel panel-default">
            <div class="panel-heading">
                @lang('app.vacancy')
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <th>@lang('app.views'):</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>@lang('app.suppliers'):</th>
                        <td><div id='suppliers'></div></td>
                    </tr>
                    <tr>
                        <th>@lang('app.candidates'):</th>
                        <td><div id='candidates'></div></td>
                    </tr>
                </table>
            </div>
        </div>-->
        @if(Auth::user()->id == $vacancy->poster_user_id Or Auth::user()->hasRole('Admin'))
           <!-- <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('app.pending_suppliers')
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td>
                            <div class="col-lg-12">
                                <div class="col-lg-8">
                                </div>
                                <div class="col-lg-4">

                                    <button class="btn btn-success btn-circle closetr" title="{{ trans('app.accept') }}" onclick="">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-circle closetr" title="{{ trans('app.reject') }}" onclick="">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>
                            </div>
                            </td>
                        </tr>

                    </table>

                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('app.pending_candidates')
                </div>
                <div class="panel-body">
                    <table class="table">

                        <tr>
                            <td>
                            <div class="col-lg-12">
                                <div class="col-lg-8">
                                </div>
                                <div class="col-lg-4">

                                     <button class="btn btn-success btn-circle closetr" title="{{ trans('app.accept') }}" onclick="">
                                         <i class="fa fa-check"></i>
                                     </button>
                                     <button class="btn btn-danger btn-circle closetr" title="{{ trans('app.reject') }}" onclick="">
                                         <i class="fa fa-remove"></i>
                                     </button>

                                </div>
                            </div>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>

        @endif

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('app.postulate_candidates')
                </div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-success btn-circle closetr" title="{{ trans('app.postule') }}" onclick="">
                                    <i class="fa fa-check"></i>
                                </button>
                            </td>
                        </tr>


                    </table>
                </div>
            </div>-->


        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('app.conditions')
            </div>
            <div class="panel-body">
                <strong>@lang('app.general_conditions'):</strong>
                <p>
                    {{ $vacancy->general_condition }}
                </p>
                <table class="table">
                    <tr>
                        <th>@lang('app.approximate_total_billing'):</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>@lang('app.comission'):</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>@lang('app.warranty'):</th>
                        <td>{{ $vacancy->warranty_employee }}</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <a href="{{route('vacancies.index')}}"><button type="button" class="btn btn-primary">
            <i class="fa fa-arrow-left "></i>
            @lang('app.back')
        </button></a>
    </div>
</div>

@stop

@section('scripts')

<script type="text/javascript">
    $(document).on('click', '.closetr', function () {
        $(this).closest("tr").remove();
    });

    function pendingSupplier(url, vacancy, supplier){
        $.get(url,
        { vacancy: vacancy,
        supplier: supplier },
        function(data) {
            console.log(data);
            $('#suppliers').html(data);
        }, 'json');
    }

    function pendingCandidate(url, vacancy, candidate){
        $.get(url,
        { vacancy: vacancy,
        candidate: candidate },
        function(data) {
            console.log(data);
            $('#candidates').html(data);
        }, 'json');
    }

    function postulateCandidate(url, vacancy, candidate){
        $.get(url,
        { vacancy: vacancy,
        candidate: candidate },
        function(data) {
            console.log(data);
        }, 'json');
    }

</script>
@stop
