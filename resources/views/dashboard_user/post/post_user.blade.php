@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')

  <!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDAD-->
        <section class="user-main-create credits jobs-detail">
            <!--TITULO-->
            <div class="jobs-detail-title">
                <h3>{{$vacancy->name}}</h3>
                <p>{{$vacancy->location}} | {{$experiencie['name']}}</p>
            </div>

            <!--CUERPO DE LA DESCRIPCION-->
            <div class="jobs-detail-body">
                <!--DESCRIPCION DE LA EMPRESA-->
                <h4>{{trans('app.description_company')}}</h4>
                <p>@if($companies) {{$companies->name}} @else {{trans('app.independent')}} @endif </p>

                <!--DESCRIPCION DEL TRABAJO-->
                <h4>{{trans('app.work_description')}}</h4>
                <p>{{$vacancy->target_companies}}</p>

                <!--EXPERIENCIA DESEADA-->
                <h4>{{trans('app.desired_experience')}}</h4>
                <ul class="jobs-detail-body-kills">
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>{{$vacancy->required_experience}}</p>
                    </li>
                  <!--  <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: .NET Framework 3.0 / 4.0 (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Bases de Datos: MS SQL Server u ORACLE (Excluyente)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: ASP.NET MVC (Deseable)</p>
                    </li>
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>Lenguajes de programación: Java Script (Deseable)</p>
                    </li>-->
                </ul>
                <!--INFORMACION ADICIONAL-->
                <h4>{{trans('app.additional_information')}}</h4>
                <p>{{$vacancy->responsabilities}}</p>

                <!--HORARIO DE TRABAJO-->
                <!--<h4>{{trans('app.working_hours')}}</h4>
                <p><span style="color:red">Este campo no esta reflejado al crear Nuevo Post</span></p>
                -->
                <!--UBICACION-->
                <h4>{{trans('app.location')}}</h4>
                <p>{{$vacancy->location}}</p>

                <!--TIPO DE CONTRATACION-->
                <h4>{{trans('app.contract_type')}}</h4>
                <p>{{$contract['name']}}</p>

                <!--ESPECIALIZACION-->
                <h4>{{trans('app.especialization')}}</h4>
                <p>{{$functionalArea['name']}}</p>

                <!--AÑOS DE EXPERIENCIA-->
                <h4>{{trans('app.experience_years')}}</h4>
                <p>{{$experiencie['name']}}</p>

                <!--IDIOMAS-->
                <h4>{{trans('app.languages')}}</h4>
                <p>
                    @if($vacancy->language_id == 1)
                        {{trans('app.spanish')}}
                    @else
                        {{trans('app.english')}}
                    @endif
                </p>

                <!--RANGO SALARIAL-->
                <h4>{{trans('app.range_salary')}}</h4>
                <p>{{$vacancy->range_salary}}</p>

                <!--HONORARIO COBRADO AL EMPLEADOR-->
                <h4>{{trans('app.employer_fee')}}</h4>
                <p>
                    @if($vacancy->group1)
                        % {{$vacancy->fee}}
                    @else
                        $ {{$vacancy->fee}} {{trans('app.fixed')}}
                    @endif
                </p>

                <!--PERIODO DE REEMPLAZO-->
                <h4>{{trans('app.replacement_period')}}</h4>
                <p>{{$replacementPeriod['name']}}</p>

                <!--LINK DESCARGA-->
                <div class="link">
                    <a href="#">
                        <figure>
                            <span class="icon-gTalents_pdf"></span>
                        </figure>
                        <p>@lang('app.job_Description')</p>
                    </a>
                </div>

                <!--RESUMEN-->
                <ul class="jobs-detail-body-resum">
                    <!--FACTURACION APROXIMADA-->
                    <li>
                        <figure class="icon-verde">
                            <span class="icon-gTalents_billetes"></span>
                        </figure>
                        <div class="datos">
                            <h4>${{$factura}}</h4>
                            <p>@lang('app.approximate_total_billing')</p>
                        </div>
                    </li>

                    <!--COMISION DEL SUPPLIER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>20% @lang('app.of_commission')</h4>
                            <p>@lang('app.supplier_commission')</p>
                        </div>
                    </li>

                    <!--COMISION DEL POSTER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>5% @lang('app.of_commission')</h4>
                            <p>@lang('app.poster_commission')</p>
                        </div>
                    </li>

                    <!--COMPENSACION DE LA POSICION-->
                    <li>
                        <figure class="icon-naranja">
                            <span class="icon-gTalents_stars"></span>
                        </figure>
                        <div class="datos">
                            <h4>25 @lang('app.points')</h4>
                            <p>@lang('app.position_compensation')</p>
                        </div>
                    </li>

                    <!--TUS GARANTIAS-->
                    <li>
                        <figure class="icon-naranja">
                            <span class="icon-gTalents_help"></span>
                        </figure>
                        <div class="datos">
                            <h4>@lang('app.your_garanties')</h4>
                            <p>@lang('app.we_watch_over_you')</p>
                        </div>
                    </li>

                    <!--COMISION GTALENTS-->
                    <li>
                        <figure>
                            <span class="icon-gTalents_isotipo"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                        </figure>
                        <div class="datos">
                            <h4>30% @lang('app.of_commission')</h4>
                            <p>@lang('app.gTalents_commission')</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!--INTERESADO - OFERTAS SIMILARES-->
        <section class="user-main-contain">

            <!--BTN NUEVO COLABORADOR-->
            @if(!in_array($vacancy->id,$userVacancy))
                <div class="btn-section">
                    <a href="#modalParticipar" class="btn-main modal-trigger waves-effect waves-light">
                        @lang('app.interested')
                    </a>
                </div>
            @endif

            <!-- RESUMEN -->
            <div class="bills">
                <div class="resum-position">
                    <!--COMISION-->
                    <div class="item">
                        <figure>
                            <span class="icon-gTalents_billetes"></span>
                        </figure>
                        <div class="datos">
                            <h4>30% @lang('app.of_commission')</h4>
                            <p>@lang('app.if_you_close_the_position')</p>
                        </div>
                    </div>

                    <!--GARANTIAS-->
                    <div class="item">
                        <figure>
                            <span class="icon-gTalents_help"></span>
                        </figure>
                        <div class="datos">
                            <h4>@lang('app.your_garanties')</h4>
                            <p>@lang('app.we_watch_over_you')</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- OFERTAS SIMILARES -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.similar_offers')</h3>
                </section>

                <!--RANGO-->
                <ul class="post-list">
                </ul>
            </div>      
        </section>
    </article>


    <!--MODAL PARTICIPAR-->
    <div id="modalParticipar" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>
            <h4>@lang('app.so_you_want_to_participate?')</h4>
        </div>

        <div class="modal-content">
            <form action="{{route('vacancies.post_supplier', $vacancy->id)}}" class="formLogin" method="POST">
                 {{ csrf_field() }}
                <!--RESUMEN SUPPLIER-->
                <div class="profile-colab profile-supplier">
                    <!--RESUMEN 1-->
                    <div class="profile-colab-message">
                        <p>@lang('app.participate_message')</p>
                    </div>
                </div>

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            @lang('app.back')
                        </a>
                    </div>

                    <!--INVITAR-->
                    <div class="item">
                        <button class="btn-main" type="submit" id="btn-modalMain">
                            @lang('app.participate')
                        </button>
                    </div>
                </section>              
            </form>

            <!--MENSAJE DE PARTICIPACION-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.participate_message_success')</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        @lang('app.continue')
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
   
@stop
