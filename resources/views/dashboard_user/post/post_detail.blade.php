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
                <p>{{$vacancy->location}} | {{$contract['name']}}</p>
            </div>

            <!--CUERPO DE LA DESCRIPCION-->
            <div class="jobs-detail-body">
                <!--DESCRIPCION DE LA EMPRESA-->
                <h4>{{trans('app.description_company')}}</h4>
                <p>{{$vacancy->name}}</p>

                <!--DESCRIPCION DEL TRABAJO-->
                <h4>{{trans('app.work_description')}}</h4>
                <p>{{$vacancy->target_companies}}
                </p>

                <!--EXPERIENCIA DESEADA-->
                <h4>{{trans('app.desired_experience')}}</h4>
                <ul class="jobs-detail-body-kills">
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>{{$vacancy->required_experience}}</p>
                    </li>
                 <!--   <li>
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
                    </li>

                <p>Es requisito contar con experiencia de 1 a 3 años en algunas de las tecnologías antes mencionadas.</p>-->
                </ul>
                <!--INFORMACION ADICIONAL-->
                <h4>@lang('app.additional_information')</h4>
                <p>{{$vacancy->responsabilities}}</p>

                <!--HORARIO DE TRABAJO-->
                <!--<h4>{{trans('app.working_hours')}}</h4>
                <p><span style="color:red"></span></p>-->

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
                    @foreach($languages as $lang)
                        {{$lang->type($language)}} : {{$lang->level()}}
                    @endforeach
                </p>

                <!--RANGO SALARIAL-->
                <h4>{{trans('app.range_salary')}}</h4>
                <p>{{$vacancy->range_salary}}</p>

                <!--HONORARIO COBRADO AL EMPLEADOR-->
                <h4>{{trans('app.employer_fee')}}</h4>
                <p>
                    @if($vacancy->group1==1)
                        {{$vacancy->fee}}%
                    @else
                        $ {{$vacancy->fee}} {{trans('app.fixed')}}
                    @endif
                </p>

                <!--PERIODO DE REEMPLAZO-->
                <h4>{{trans('app.replacement_period')}}</h4>
                <p>{{$replacementPeriod['name']}}</p>

                <!--LINK DESCARGA-->
                <div class="row">
                @if($vacancy->file_job_description!='')
                    <div class="col s6">
                        <div class="link">
                            <a @if($vacancy->file_job_description!='') href="/upload/job/{{$vacancy->file_job_description}}" download @else href="#" @endif>
                                <figure>
                                    <span class="icon-gTalents_pdf"></span>
                                </figure>
                                <p>@lang('app.job_Description')</p>
                            </a>
                        </div>
                    </div>
                @endif
                @if($vacancy->file_employer!='')
                    <div class="col s6">
                        <div class="link">
                            <a @if($vacancy->file_employer!='') href="/upload/employer/{{$vacancy->file_employer}}" download @else href="#" @endif>
                                <figure>
                                    <span class="icon-gTalents_pdf"></span>
                                </figure>
                                <p>@lang('app.agreement_employer')</p>
                            </a>
                        </div>
                    </div>
                @endif
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
                            <h4>{{$userCategorie->supplier_percent}}% @lang('app.of_commission')</h4>
                            <p>@lang('app.supplier_commission')</p>
                        </div>
                    </li>

                    <!--COMISION DEL POSTER-->
                    <li>
                        <figure class="icon-gris">
                            <span class="icon-gTalents_coins"></span>
                        </figure>
                        <div class="datos">
                            <h4>{{$userCategorie->poster_percent}}% @lang('app.of_commission')</h4>
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
                            <h4>{{$userCategorie->gtalents_percent}}% @lang('app.of_commission')</h4>
                            <p>@lang('app.gTalents_commission')</p>
                        </div>
                    </li>
                </ul>
            </div>
        </section>

        <!--INTERESADO - OFERTAS SIMILARES-->
        <section class="user-main-contain">
            @if($vacancy->vacancy_status_id==1 || $vacancy->vacancy_status_id==2 || $vacancy->vacancy_status_id==5 || $vacancy->vacancy_status_id==6)
            <div class="btn-section">
                <a href="{{route('vacancies.edit.front', $vacancy->id)}}" class="btn-main modal-trigger waves-effect waves-light">
                    @lang('app.edit')
                </a>
            </div>
            @endif
            <!-- RESUMEN -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.your_opportunity')</h3>
                </section>

                <!--CIRCULO RESUMEN-->
                <div class="item-circle">
                    <figure>
                        <h4>{{count($candidatesUnReadCount)}}</h4>
                        <span>@lang('app.not_read')</span>
                    </figure>
                </div>

                <!--RESUMEN INDICES-->
                <div class="item-resumVisitas">
                    <!--SUPPLIER-->
                    <div class="item-option">
                        <h4>{{count($suppliers)}}</h4>
                        <span class="opt-sm">@lang('app.suppliers')</span>
                    </div>

                    <!--CANDIDATOS-->
                    <div class="item-option">
                        <h4>{{count($candidatesApproved)}}</h4>
                        <span class="opt-sm">@lang('app.candidates')</span>
                    </div>

                    <!--VISITAS-->
                    <div class="item-option">
                        <h4>{{$viewed}}</h4>
                        <span class="opt-sm">@lang('app.visits')</span>
                    </div>
                </div>
            </div>

            <!--INVITAR SUPPLIER EXTERNO-->
            @if($vacancy->vacancy_status_id==1 || $vacancy->vacancy_status_id==5)
            <div class="btn-section">
                <a href="#modalInvitar" class="btn-main modal-trigger waves-effect waves-light">
                    @lang('app.invite_external_supplier_to_platform')
                </a>
            </div>

            <!-- LISTADO EQUIPOS Y CANDIDATOS -->
            <div class="user-main-contain-resumTeam">
                <ul class="tabs">
                    <li class="tab">
                        <a class="active" href="#mySuppliers">@lang('app.suppliers')</a>
                    </li>
                    <li class="tab">
                        <a href="#myCandidates">@lang('app.candidates')</a>
                    </li>
                    <li class="tab">
                        <a href="#noLeidos">@lang('app.not_read')</a>
                    </li>
                </ul>

                <!--MIS SUPPLIERS-->
                <div class="team-container g-general" id="mySuppliers">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($suppliers)}} @lang('app.suppliers')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.supplier_name')}}" id="search-supplier">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <ul class="team" id="list-supplier">

                        <!-- SUPPLIERS -->
                        @foreach($suppliers as $supplier)
                            <li>
                                <section class="team-card">
                                    <!--RESUMEN SUPPLIER-->
                                    <section class="supplierContain1">
                                        <!--ICONO RANGO-->
                                        <figure class="supplierContain1-ranking">
                                            <span class="icon-gTalents_rango-{{$supplier->supplier->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                        </figure>

                                        <div class="datos">
                                            <h4>{{$supplier->supplier->code}}</h4>
                                            <p>{{$supplier->supplier->company[0]->category->name}}</p>
                                        </div>
                                    </section>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-team01'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-team01' class='dropdown-content'>
                                            <li><a href="#modalCalificar{{$supplier->supplier_user_id}}" class="modal-trigger waves-effect waves-light">@lang('app.qualify')</a></li>
                                            <form action="{{route('vacancies.reject.supplier',$vacancy->id)}}" method="POST">
                                                {{csrf_field()}}
                                                <input type="hidden" value="{{$supplier->supplier_user_id}}" name="supplier">
                                                <li class="send_form">
                                                    <a href="#">@lang('app.discard')</a>
                                                </li>
                                            </form>
                                        </ul>
                                        @include('dashboard_user.post.partials.modalcalificate')
                                    </div>
                                </section>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- MIS CANDIDATOS -->
                <div class="team-container g-general" id="myCandidates">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($candidatesApproved)}} @lang('app.candidates')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.name_candidates')}}" id="search-candidates">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team" id="list-candidates">
                        <!-- CANDIDATO 1 -->
                        @foreach($candidatesApproved as $candidate)
                            <li>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>{{substr($candidate['first_name'].' '.$candidate['last_name'], 0, 20)}}</h3>
                                            <p>{{substr($candidate['actual_position'], 0, 20)}}</p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-colb{{$candidate['id']}}'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-colb{{$candidate['id']}}' class='dropdown-content'>
                                            @if($candidate['file']!='')
                                                <li><a href="/upload/docs/{{$candidate['file']}}" class="cv_candidate" target="_blank">@lang('app.view_cv')</a></li>
                                            @else
                                                <li><a href="#">@lang('app.view_cv')</a></li>
                                            @endif
                                            <!--href="#modalHistorico"-->
                                            <li class="open-modal-history" value="{{$candidate['id']}}"><a class="waves-effect waves-light">@lang('app.historical')</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- NO LEIDOS -->
                <div class="team-container" id="noLeidos">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($candidatesUnRead)}} @lang('app.not_read')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.name_candidates')}}" id="search-candidates-unread">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team" id="list-candidates-unread">
                        <!-- CANDIDATO 1 -->
                        @foreach($candidatesUnRead as $candidate)
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>{{substr($candidate['first_name'].' '.$candidate['last_name'], 0, 20)}}</h3>
                                        <p>{{substr($candidate['actual_position'], 0, 20)}}</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido{{$candidate['id']}}'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido{{$candidate['id']}}' class='dropdown-content'>
                                        @if($candidate['file']!='')
                                            <li class="read_candidate" value="{{$candidate['id']}}"><a href="/upload/docs/{{$candidate['file']}}" class="cv_candidate" target="_blank">@lang('app.view_cv')</a></li>
                                        @else
                                            <li><a href="#">@lang('app.view_cv')</a></li>
                                        @endif
                                        <li><a href="#modalNota{{$candidate['id']}}" class="modal-trigger waves-effect waves-light">@lang('app.view_note')</a></li>
                                        <form method="POST" action="{{route('vacancies.approbate.candidate',$candidate['id'])}}">
                                            {{csrf_field()}}
                                            <li class="send_form">
                                                <input type="hidden" name="vacancy" value="{{$vacancy->id}}">
                                                <a href="#">@lang('app.accept')</a>
                                            </li>
                                        </form>
                                        <form method="POST" action="{{route('vacancies.reject.candidate',$candidate['id'])}}">
                                            {{csrf_field()}}
                                            <li class="send_form">
                                                <input type="hidden" name="vacancy" value="{{$vacancy->id}}">
                                                <a href="#" >@lang('app.discard')</a>
                                            </li>
                                        </form>
                                    </ul>
                                    <?php $modal = $candidate['id']; ?>
                                    @include('dashboard_user.post.partials.modalnote')
                                </div>
                            </section>
                        </li>
                        @endforeach
                    </ul>

                    <!--VER TODOS LOS NO LEIDOS -->
                    <section class="new-team">
                        <a href="#modalnoLeidos" class="modal-trigger waves-effect waves-light">
                            <p>@lang('app.view_all')</p>
                        </a>
                    </section>
                </div>
            </div>

            <!-- RECOMENDACIONES SUPPLIERS -->
            <div class="bills">
                <section class="bills-title">
                    <h3>@lang('app.we_recommend_you')</h3>
                </section>
                <ul class="alerts-div supplier-recomend" id="add_new_sup">
                    @foreach($supliers_recommended as $supplier)
                    <li>
                        <div class="motivo">

                            <section class="supplierContain1">

                                <figure class="supplierContain1-ranking">
                                    <span class="icon-gTalents_rango-{{$supplier->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                </figure>

                                <div class="datos">
                                    <h4>{{$supplier->code}}</h4>
                                    <p>{{$supplier->company[0]->category->name}}</p>
                                </div>
                            </section>

                            <div class="addSupplier">

                                <div class="link">
                                    <a modal="modalProfileSupplier{{$supplier->id}}" href="#modalProfileSupplier{{$supplier->id}}" class="waves-effect waves-light">
                                        <span class="icon-gTalents_profile"></span>
                                    </a>
                                </div>

                                <div class="link">
                                    <form method="POST" action="{{route('vacancies.invited.supplier', $vacancy->id)}}">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$supplier->id}}" name="supplier">
                                        <a href="#" class="send_form">
                                            <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                        </a>
                                    </form>
                                </div>
                            </div>
                            @include('dashboard_user.post.partials.modalsupplier')
                        </div>
                        <span val="{{$supplier->id}}" class="new_supplier icon-gTalents_close close-alert"></span>
                    </li>
                    @endforeach
                </ul>

                <!--
                <section class="new-team">
                    <a href="{{route('supplier.index')}}">
                        <p>@lang('app.see_more') Supplier</p>
                    </a>
                </section>    -->
            </div>
                @endif
        </section>
    </article>


    <!--MODAL INVITAR SUPPLIER-->
    <div id="modalInvitar" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.invite_external_supplier')</h4>
        </div>

        <div class="modal-content">
            <form action="{{route('vacancies.invited.supplier.external', $vacancy->id)}}" role='form' method="POST" id="formCreate" class="formLogin">
                <!--NOMBRE-->
                {{csrf_field()}}
                <div class="itemForm">
                    <label>@lang('app.name')</label>
                    <input type="text" name="name" data-error=".errorTxtName" placeholder="{{trans('app.name')}}">
                    <div class="errorTxtName"></div>
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    <label>{{trans('app.email')}}</label>
                    <input type="email" placeholder="{{trans('app.email')}}" name="email" data-error=".errorTxtEmail">
                    <div class="errorTxtEmail"></div>
                </div>

                <!--MENSJE-->
                <div class="itemForm icon-help">
                    <label>@lang('app.message')</label>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="{{trans('app.message_invited')}}"></textarea>
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
                            @lang('app.invited')
                        </button>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.message_created')</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        @lang('app.continue')
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL VER TODOS LOS NO LEIDOS-->
    <div id="modalnoLeidos" class="modal modal-userRegistered modal-noLeido">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.candidates') @lang('app.not_read')</h4>
        </div>

        <div class="modal-content">
            
            <!--INPUT SEARCH-->
            <article class="postList-contain-filter">
                <form action="" class="formLogin">

                    <!--BUSQUEDA-->
                    <div class="itemForm">
                        <input type="text" placeholder="{{trans('app.what_search')}}" class="input-search" id="search-can">
                    </div>
                    
                </form>
            </article>

            <!--LISTADO DE CANDIDATOS-->
            <ul class="supplier-container supplier-list" id="list-can">
                <!-- CANDIDATO 1 -->
                @foreach($candidatesUnRead as $candidate)
                    <li>
                        <section class="team-card">
                            <!--PERSONA-->
                            <div class="team-card-person">
                                <figure>
                                    <span class="icon-gTalents_team-48"></span>
                                </figure>
                                <div class="datos">
                                    <h3>{{substr($candidate['first_name'].' '.$candidate['last_name'], 0, 20)}}</h3>
                                    <p>{{substr($candidate['actual_position'], 0, 20)}}</p>
                                </div>
                            </div>

                            <!--OPCIONES-->
                            <div class="options">
                                <!-- Dropdown Trigger -->
                                <a class='dropdown-button' href='#' data-activates='option-nole{{$candidate['id']}}'>
                                    <span class="icon-gTalents_submenu"></span>
                                </a>

                                <!-- Dropdown Structure -->
                                <ul id='option-nole{{$candidate['id']}}' class='dropdown-content'>
                                    @if($candidate['file']!='')
                                        <li class="read_candidate" value="{{$candidate['id']}}"><a href="/upload/docs/{{$candidate['file']}}" class="cv_candidate" target="_blank">@lang('app.view_cv')</a></li>
                                    @else
                                        <li><a href="#">@lang('app.view_cv')</a></li>
                                    @endif
                                    <form method="POST" action="{{route('vacancies.approbate.candidate',$candidate['id'])}}">
                                        {{csrf_field()}}
                                        <li class="send_form">
                                            <input type="hidden" name="vacancy" value="{{$vacancy->id}}">
                                            <a href="#">@lang('app.accept')</a>
                                        </li>
                                    </form>
                                    <form method="POST" action="{{route('vacancies.reject.candidate',$candidate['id'])}}">
                                        {{csrf_field()}}
                                        <li class="send_form">
                                            <input type="hidden" name="vacancy" value="{{$vacancy->id}}">
                                            <a href="#" >@lang('app.discard')</a>
                                        </li>
                                    </form>
                                </ul>
                                <?php $modal = $candidate['id'].'external'; ?>
                                @include('dashboard_user.post.partials.modalnote')
                            </div>
                        </section>
                    </li>
                @endforeach
            </ul>

            <!--PAGINADOR-->
            <!--
            <ul class="pagination">
                <li class="disabled">
                    <a href="#">
                        <span class="icon-gTalents_left"></span>
                    </a>
                </li>
                <li class="active"><a href="#">1</a></li>
                <li class="waves-effect"><a href="#">2</a></li>
                <li class="waves-effect"><a href="#">3</a></li>
                <li class="waves-effect"><a href="#">4</a></li>
                <li class="waves-effect"><a href="#">5</a></li>
                <li class="waves-effect">
                    <a href="#">
                        <span class="icon-gTalents_right"></span>
                    </a>
                </li>
            </ul>-->

        </div>
    </div>

<div id="modalHistorico" class="modal modal-userRegistered">

    <div class="modal-header">
        <!--CERRAR MODAL-->
        <div class="close">
            <a href="#!" class="modal-action modal-close">
                <span class="icon-gTalents_close-2"></span>
            </a>
        </div>

        <h4>@lang('app.candidate_historical')</h4>
    </div>

    <div class="modal-content">
        <!--TARJETA DEL CANDIDATO-->
        <div class="profile-colab">
            <section class="team-card">
                <!--PERSONA-->
                <div class="team-card-person">
                    <figure>
                        <span class="icon-gTalents_team-48"></span>
                    </figure>
                    <div class="datos">

                    </div>
                </div>

                <!--DESCARGAR CV-->
                <div class="link">

                </div>
            </section>

            <!--RESPUESTA-->
            <form action="{{route('vacancies.contract.candidate', $vacancy->id)}}" method="GET" class="formLogin form-status">
                <!--SELECTOR DE ESTATUS-->
                <div class="itemForm">
                    <select class="browser-default">
                        <option value="1" selected>Estatus 1</option>
                        <option value="2">Estatus 2</option>
                        <option value="3">Estatus 3</option>
                    </select>
                </div>

                <!--HISTORIAL DE ESTATUS-->
                <ul class="historial-status">
                    <!--ESTATUS 1-->

                </ul>
                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            @lang('app.back')
                        </a>
                    </div>

                    <div class="item">
                        <button type="submit" class="btn-main" id="btn-modalMain">
                            @lang('app.contract')
                        </button>
                    </div>
                </section>
            </form>
        </div>
    </div>
@stop

@section('scripts')
   <script>
       $(document).ready(function(){
           $('body').on('click','.modal-job',function(){
               $('#'+$(this).attr('modal')).modal('open');
           });
           new_sup = true;
           exclude_sup = [];
           @foreach($supliers_recommended as $supplier)
               exclude_sup.push("{{$supplier->id}}");
           @endforeach
            $('body').on('click','.new_supplier',function (e) {
               if(new_sup){
                   new_sup = false;
                   $.ajax({
                       url: "{{route('vacancies.show.getsuppliers',$vacancy->id)}}?exclude="+exclude_sup.toString(),
                       method: 'GET',
                       success:function(response){
                           for(var i = 0; i<response.data.length;i++){
                               exclude_sup.push(response.data[i].id);
                           }
                           console.log(response.html);
                           $('#add_new_sup').append(response.html);
                           new_sup = true;
                           //INICIALIZAR MODALES
                           $('.modal-trigger').leanModal();
                           try {
                               $('.modal').modal();
                           }
                           catch(err) {
                               console.log('che');
                           }
                       }
                   });
               } else {
                   e.preventDefault();
                   e.stopPropagation();
                   return false;
               }
           });

           $('#search-supplier').keyup(function(){
              if($(this).val().length>=2){
                  $('#list-supplier > li').show();
                  value = $(this).val().toLowerCase();
                  $('#list-supplier > li').each(function() {
                      var title = $(this).find('.datos h4').html().toLowerCase();
                      var subtitle = $(this).find('.datos p').html().toLowerCase();
                      if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                          $(this).hide();
                      }
                  });
              } else {
                  $('#list-supplier > li').show();
              }
           });

           $('#search-candidates').keyup(function(){
               if($(this).val().length>=2){
                   $('#list-candidates > li').show();
                   value = $(this).val().toLowerCase();
                   $('#list-candidates > li').each(function() {
                       var title = $(this).find('.datos h3').html().toLowerCase();
                       var subtitle = $(this).find('.datos p').html().toLowerCase();
                       if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                           $(this).hide();
                       }
                   });
               } else {
                   $('#list-candidates > li').show();
               }
           });

           $('#search-candidates-unread').keyup(function(){
               if($(this).val().length>=2){
                   $('#list-candidates-unread > li').show();
                   value = $(this).val().toLowerCase();
                   $('#list-candidates-unread > li').each(function() {
                       var title = $(this).find('.datos h3').html().toLowerCase();
                       var subtitle = $(this).find('.datos p').html().toLowerCase();
                       if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                           $(this).hide();
                       }
                   });
               } else {
                   $('#list-candidates-unread > li').show();
               }
           });

           $('#search-can').keyup(function(){
               if($(this).val().length>=2){
                   $('#list-can > li').show();
                   value = $(this).val().toLowerCase();
                   $('#list-can > li').each(function() {
                       var title = $(this).find('.datos h3').html().toLowerCase();
                       var subtitle = $(this).find('.datos p').html().toLowerCase();
                       if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                           $(this).hide();
                       }
                   });
               } else {
                   $('#list-can > li').show();
               }
           });

           $("#formCreate").validate({
               rules: {
                   name: {
                       required: true,
                       minlength: 3
                   },
                   email: {
                       required: true,
                       email: true
                   },
               },
               messages: {
                   name: {
                       required: "{{trans('app.candidate_validate.first_name_required')}}",
                       minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                   },
                   email: {
                       required: "{{trans('app.candidate_validate.email_required')}}",
                       email: "{{trans('app.candidate_validate.email_valid')}}"
                   },
               },
               errorElement : 'div',
               errorPlacement: function(error, element) {
                   var placement = $(element).data('error');
                   if (placement) {
                       $(placement).append(error)
                   } else {
                       error.insertAfter(element);
                   }
               }
           });

           $('.read_candidate').click(function(){
               $.ajax({
                   url: "/vacancies/"+$(this).attr('value')+"/read/candidate",
                   method: "POST",
                   data: "vacancy={{$vacancy->id}}&_token={{csrf_token()}}",
                   success: function(result){
                       console.log(result);
                   }
               });
           });

           $('.open-modal-history').click(function(){
               var candidates = [];
               candidates.id = $(this).attr('value');
               candidates.name = $(this).parent().parent().parent().find('.datos h3').html();
               candidates.position = $(this).parent().parent().parent().find('.datos p').html();
               candidates.cv = $(this).parent().find('.cv_candidate').attr('href');
               $.ajax({url: "/vacancies/"+candidates.id+"/history/candidate?vacancy={{$vacancy->id}}",
                   success: function(result){
                       $('#modalHistorico .datos').html('<h3>'+candidates.name+'</h3><p>'+candidates.position+'</p>');
                       if(candidates.cv!=undefined){
                           $('#modalHistorico .link').html('<a href="'+candidates.cv+'" target="_blank"><span class="icon-gTalents_download"></span></a>');
                       } else {
                           $('#modalHistorico .link').html('<a href="#" target="_blank"><span class="icon-gTalents_download"></span></a>');
                       }
                       var html = '';
                       for(var i = 0; i < result.length; i++){
                           html += '<li><span class="icon-gTalents_point"></span><p>'+result[i].created_at+'</p><p>'+result[i].status+'</p></li>';
                       }
                       $('.historial-status').html(html+'<input type="hidden" name="candidate" value="'+candidates.id+'">');
                       $('#modalHistorico').modal('open');
                   }
               });
           });
       });
   </script>
@stop
