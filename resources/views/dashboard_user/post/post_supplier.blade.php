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
                            <h4>1.500 @lang('app.points')</h4>
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

            <!-- RESUMEN -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.opportunities')</h3>
                </section>

                <!--CIRCULO RESUMEN-->
                <div class="item-circle">
                    <figure>
                        <h4>57</h4>
                        <span>@lang('app.visits')</span>
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
                </div>
            </div>

            <!-- LISTADO EQUIPOS Y CANDIDATOS -->
            <div class="user-main-contain-resumTeam">
                <ul class="tabs">
                    <li class="tab">
                        <a class="active" href="#mySuppliers">@lang('app.available')</a>
                    </li>
                    <li class="tab">
                        <a href="#myCandidates">@lang('app.in_progress')</a>
                    </li>
                    <li class="tab">
                        <a href="#noLeidos">@lang('app.rejected')</a>
                    </li>
                </ul>

                <!--CANDIDATOS DISPONIBLES-->
                <div class="team-container" id="mySuppliers">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($userCandidates)}} @lang('app.candidates')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <form action="" class="formLogin select-colab">
                        <ul class="team">
                            <!-- SUPPLIER 1 -->
                            @foreach($userCandidates as $candidate)
                                <li>
                                    <p class="check">
                                        <input type="checkbox" id="test5" name="candidates_send[]" value="{{$candidate->id}}"/>
                                        <label for="test5"></label>
                                    </p>
                                    <section class="team-card">
                                        <!--PERSONA-->
                                        <div class="team-card-person">
                                            <div class="datos">
                                                <h3>{{$candidate->first_name}} {{$candidate->last_name}}</h3>
                                                <p>{{substr($candidate->actual_position->name, 0, 20)}}</p>
                                            </div>
                                        </div>

                                        <!--OPCIONES-->
                                        <div class="options">
                                            <!-- Dropdown Trigger -->
                                            <a class='dropdown-button' href='#' data-activates='option-team01'>
                                                <span class="icon-gTalents_submenu"></span>
                                            </a>

                                            <!-- Dropdown Structure -->
                                            <ul id='option-team01' class='dropdown-content'>
                                                <li><a href="#">@lang('app.view_cv')</a></li>
                                                <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">@lang('app.historical')</a></li>
                                                <!--<li><a href="#">@lang('app.discard')</a></li>-->
                                            </ul>
                                        </div>
                                    </section>
                                </li>
                            @endforeach
                        </ul>

                        <div class="send-colab">
                            <a href="#modalSendColab" class="modal-trigger waves-effect waves-light">
                                @lang('app.send_candidates')
                            </a>
                        </div>                      
                    </form>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewCandidato" class="modal-trigger waves-effect waves-light">
                            <p>@lang('app.new_candidate')</p>
                        </a>
                    </section>
                </div>

                <!-- MIS CANDIDATOS EN CURSO -->
                <div class="team-container g-general" id="myCandidates">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>51 @lang('app.candidates')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team">
                        <!-- CANDIDATO 1 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>FrontEnd Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb1'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb1' class='dropdown-content'>
                                        <li><a href="#">@lang('app.view_cv')</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">@lang('app.historical')</a></li>
                                    <!--<li><a href="#">@lang('app.discard')</a></li>-->
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>
                </div>

                <!-- RECHAZADOS -->
                <div class="team-container g-general" id="noLeidos">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>22 No Leidos</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team">
                        <!-- CANDIDATO 1 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>FrontEnd Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido1'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido1' class='dropdown-content'>
                                        <li><a href="#">@lang('app.view_cv')</a></li>
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">@lang('app.historical')</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </article>


    <!--MODAL NUEVO CANDIDATO-->
    @include('dashboard_user.candidate.partials.modalcreate')

    <!--MODAL CALIFICAR SUPPLIER-->
    <div id="modalSendColab" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Enviar Candidatos</h4>
        </div>

        <div class="modal-content">

            <!--RESPUESTA-->
            <form action="" class="formLogin">
                <!--SLIDER DE CANDIDATOS SELECCIONADOS-->
                <div class="slider">
                    <ul class="slides">
                        <!-- CANDIDATO 1-->
                        <li>
                            <!--TARJETA DEL CANDIDATO-->
                            <div class="profile-colab">
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>Andres Gonzalez</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--DESCARGAR CV-->
                                    <div class="link">
                                        <a href="#">
                                            <span class="icon-gTalents_download"></span>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </li>

                        <!-- CANDIDATO 2-->
                        <li>
                            <!--TARJETA DEL CANDIDATO-->
                            <div class="profile-colab">
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>COLF-857</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--DESCARGAR CV-->
                                    <div class="link">
                                        <a href="#">
                                            <span class="icon-gTalents_download"></span>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </li>

                        <!-- CANDIDATO 3-->
                        <li>
                            <!--TARJETA DEL CANDIDATO-->
                            <div class="profile-colab">
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>VEF-785</h3>
                                            <p>FrontEnd Developer</p>
                                        </div>
                                    </div>

                                    <!--DESCARGAR CV-->
                                    <div class="link">
                                        <a href="#">
                                            <span class="icon-gTalents_download"></span>
                                        </a>
                                    </div>
                                </section>
                            </div>
                        </li>
                    </ul>
                </div>

                        <!--MENSAJE-->
                        <div class="itemForm icon-help">
                            <label>Escribe tu comentario</label>
                            <textarea name="" id="" cols="30" rows="10" placeholder="Escribe tu comentario"></textarea>
                        </div>

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Regresar
                        </a>
                    </div>

                    <!--INVITAR-->
                    <div class="item">
                        <a href="#" class="btn-main" type="submit" id="btn-modalMain">
                            Invitar
                        </a>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Candidatos enviados exitosamente</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL VER NOTAS DE CANDIDATOS-->
    <div id="modalHistorico" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Historico del Candidato</h4>
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
                            <h3>Andres Gonzalez</h3>
                            <p>FrontEnd Developer</p>
                        </div>
                    </div>

                    <!--DESCARGAR CV-->
                    <div class="link">
                        <a href="#">
                            <span class="icon-gTalents_download"></span>
                        </a>
                    </div>
                </section>

            <!--RESPUESTA-->
            <form action="" class="formLogin form-status">
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
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 1</p>
                    </li>

                    <!--ESTATUS 2-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 2</p>
                    </li>

                    <!--ESTATUS 3-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 3</p>
                    </li>

                    <!--ESTATUS 4-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 4</p>
                    </li>

                    <!--ESTATUS 5-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 5</p>
                    </li>

                    <!--ESTATUS 6-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 6</p>
                    </li>

                    <!--ESTATUS 7-->
                    <li>
                        <span class="icon-gTalents_point"></span>
                        <p>15 Ene</p>
                        <p>Estatus 7</p>
                    </li>
                </ul>
                

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Regresar
                        </a>
                    </div>

                    <!--CONTRATAR-->
                    <div class="item">
                        <a href="contratar.php" class="btn-main" type="submit" id="btn-modalMain">
                            Contratar
                        </a>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Mensaje enviado exitosamente</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
   
@stop
