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
                </ul>
                <p>Es requisito contar con experiencia de 1 a 3 años en algunas de las tecnologías antes mencionadas.</p>-->

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
                        $ {{$vacancy->fee}} {{trans('app.fixed')}})
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
                    <h3>@lang('app.your_opportunity')</h3>
                </section>

                <!--CIRCULO RESUMEN-->
                <div class="item-circle">
                    <figure>
                        <h4>9</h4>
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
                        <h4>25</h4>
                        <span class="opt-sm">@lang('app.visits')</span>
                    </div>
                </div>
            </div>

            <!--INVITAR SUPPLIER EXTERNO-->
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
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <ul class="team">

                        <!-- SUPPLIERS -->
                        @foreach($suppliers as $supplier)
                            <li>
                                <section class="team-card">
                                    <!--RESUMEN SUPPLIER-->
                                    <section class="supplierContain1">
                                        <!--ICONO RANGO-->
                                        <figure class="supplierContain1-ranking">
                                            <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                                        </figure>

                                        <div class="datos">
                                            <h4>{{$supplier->supplier->code}}</h4>
                                            <p>Newbie</p>
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
                                            <li><a href="#modalCalificar" class="modal-trigger waves-effect waves-light">@lang('app.qualify')</a></li>
                                            <li><a href="#">@lang('app.discard')</a></li>
                                        </ul>
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
                            <p>51 Candidatos</p>

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
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 2 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Backend Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb2'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb2' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 3 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>UX/UI Designer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb3'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb3' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 4 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Diseñador Grafico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb4'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb4' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 5 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Chef</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb5'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb5' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 6 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Ayudante de Cocina</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-colb6'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-colb6' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>                   
                </div>

                <!-- NO LEIDOS -->
                <div class="team-container" id="noLeidos">
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
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                        <li><a href="#">Aceptar</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 2 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Backend Developer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido2'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido2' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                        <li><a href="#">Aceptar</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 3 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>UX/UI Designer</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido3'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido3' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                        <li><a href="#">Aceptar</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 4 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Diseñador Grafico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido4'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido4' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                        <li><a href="#">Aceptar</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 5 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Chef</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido5'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido5' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                        <li><a href="#">Aceptar</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- CANDIDATO 6 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Ayudante de Cocina</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-noleido6'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-noleido6' class='dropdown-content'>
                                        <li><a href="#">Ver CV</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">Ver Nota</a></li>
                                        <li><a href="#">Aceptar</a></li>
                                        <li><a href="#">Descartar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>

                    <!--VER TODOS LOS NO LEIDOS -->
                    <section class="new-team">
                        <a href="#modalnoLeidos" class="modal-trigger waves-effect waves-light">
                            <p>Ver todos</p>
                        </a>
                    </section>                  
                </div>
            </div>

            <!-- RECOMENDACIONES SUPPLIERS -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>Te recomendamos</h3>
                </section>

                <!--ALERTAS-->
                <ul class="alerts-div supplier-recomend">
                    <!--RECOMENDACION 1-->
                    <li>
                        <div class="motivo">
                            <!--RESUMEN SUPPLIER-->
                            <section class="supplierContain1">
                                <!--ICONO RANGO-->
                                <figure class="supplierContain1-ranking">
                                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                                </figure>

                                <div class="datos">
                                    <h4>QDT876</h4>
                                    <p>Newbie</p>
                                </div>
                            </section>

                            <div class="addSupplier">
                                <!--PERFIL-->
                                <div class="link">
                                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                                        <span class="icon-gTalents_profile"></span>
                                    </a>
                                </div>

                                <!--AGREGAR SUPPLIER-->
                                <div class="link">
                                    <a href="!">
                                        <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--BTN ELIMINAR -->
                        <span class="icon-gTalents_close close-alert"></span>
                    </li>

                    <!--RECOMENDACION 2-->
                    <li>
                        <div class="motivo">
                            <!--RESUMEN SUPPLIER-->
                            <section class="supplierContain1">
                                <!--ICONO RANGO-->
                                <figure class="supplierContain1-ranking">
                                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                                </figure>

                                <div class="datos">
                                    <h4>QDT876</h4>
                                    <p>Newbie</p>
                                </div>
                            </section>

                            <div class="addSupplier">
                                <!--PERFIL-->
                                <div class="link">
                                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                                        <span class="icon-gTalents_profile"></span>
                                    </a>
                                </div>

                                <!--AGREGAR SUPPLIER-->
                                <div class="link">
                                    <a href="!">
                                        <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--BTN ELIMINAR -->
                        <span class="icon-gTalents_close close-alert"></span>
                    </li>

                    <!--RECOMENDACION 3-->
                    <li>
                        <div class="motivo">
                            <!--RESUMEN SUPPLIER-->
                            <section class="supplierContain1">
                                <!--ICONO RANGO-->
                                <figure class="supplierContain1-ranking">
                                    <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                                </figure>

                                <div class="datos">
                                    <h4>QDT876</h4>
                                    <p>Newbie</p>
                                </div>
                            </section>

                            <div class="addSupplier">
                                <!--PERFIL-->
                                <div class="link">
                                    <a href="#modalProfileSupplier" class="modal-trigger waves-effect waves-light">
                                        <span class="icon-gTalents_profile"></span>
                                    </a>
                                </div>

                                <!--AGREGAR SUPPLIER-->
                                <div class="link">
                                    <a href="!">
                                        <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--BTN ELIMINAR -->
                        <span class="icon-gTalents_close close-alert"></span>
                    </li>
                </ul>

                <!--AGREGAR NUEVO COLABORADOR -->
                <section class="new-team">
                    <a href="supplier-list.php">
                        <p>Más Supplier</p>
                    </a>
                </section>          
            </div>  
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
            <form action="" class="formLogin">
                <!--NOMBRE-->
                <div class="itemForm">
                    <label>@lang('app.name')</label>
                    <input type="text" placeholder="{{trans('app.name')}}">
                    <span>@lang('app.invalid_name')</span>
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    <label>{{trans('app.email')}}</label>
                    <input type="email" placeholder="{{trans('app.email')}}">
                    <span>@lang('app.invalid_email')</span>
                </div>

                <!--MENSJE-->
                <div class="itemForm icon-help">
                    <label>@lang('app.message')</label>
                    <textarea name="" id="" cols="30" rows="10" placeholder="{{trans('app.message_invited')}}"></textarea>
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
                        <a href="#" class="btn-main" type="submit" id="btn-modalMain">
                            @lang('app.invited')
                        </a>
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

    <!--MODAL CALIFICAR SUPPLIER-->
    <div id="modalCalificar" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.rate_supplier')</h4>
        </div>

        <div class="modal-content">
            <!--TARJETA DEL CANDIDATO-->
            <div class="profile-colab calificar-supplier">
                <section class="team-card">
                    <!--RESUMEN SUPPLIER-->
                    <section class="supplierContain1">
                        <!--ICONO RANGO-->
                        <figure class="supplierContain1-ranking">
                            <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                        </figure>

                        <div class="datos">
                            <h4>QDT876</h4>
                            <p>Newbie</p>
                        </div>
                    </section>
                    
                    <p class="note">
                        @lang('app.he_offer') 15 @lang('app.candidates')
                    </p>
                </section>

                <!--ESTRELLAS-->
                <div class="stars-feedback">
                    <select id="stars1" name="rating" autocomplete="off">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>

            <!--RESPUESTA-->
            <form action="" class="formLogin">
                <!--MENSJE-->
                <div class="itemForm icon-help">
                    <label>@lang('app.what_is_your_opinion?')</label>
                    <textarea name="" id="" cols="30" rows="10" placeholder="¿Cuál es tu opinión?"></textarea>
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
                        <a href="#" class="btn-main" type="submit" id="btn-modalMain">
                            @lang('app.qualify')
                        </a>
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

    <!--MODAL VER NOTAS DE CANDIDATOS-->
    <div id="modalNota" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Perfil Candidato</h4>
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

                <!--MENSAJE DEL SUPPLIER-->
                <div class="profile-colab-message">
                    <h4>REF-0547 dice:</h4>
                    <p>Te recomiendo este perfil, creo que encaja con lo que buscas</p>
                </div>
            </div>

            <!--RESPUESTA-->
            <form action="" class="formLogin">
                <!--MENSJE-->
                <div class="itemForm icon-help">
                    <label>Tu Respuesta</label>
                    <textarea name="" id="" cols="30" rows="10" placeholder="Escribe una Respuesta"></textarea>
                </div>

                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Regresar
                        </a>
                    </div>

                    <!--DESCARTAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            Descartar
                        </a>
                    </div>

                    <!--ACEPTAR-->
                    <div class="item">
                        <a href="#" class="btn-main" type="submit" id="btn-modalMain">
                            Aceptar
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

    <!--MODAL VER TODOS LOS NO LEIDOS-->
    <div id="modalnoLeidos" class="modal modal-userRegistered modal-noLeido">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Candidatos No Leidos</h4>
        </div>

        <div class="modal-content">
            
            <!--INPUT SEARCH-->
            <article class="postList-contain-filter">
                <form action="" class="formLogin">

                    <!--BUSQUEDA-->
                    <div class="itemForm">
                        <input type="text" placeholder="¿Qué buscas?" class="input-search">
                    </div>
                    
                </form>
            </article>

            <!--LISTADO DE CANDIDATOS-->
            <ul class="supplier-container supplier-list">
                <!-- CANDIDATO 1 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team1'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team1' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 2 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team2'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team2' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 3 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team3'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team3' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 4 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team4'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team4' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 5 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team5'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team5' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 6 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team6'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team6' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 7 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team7'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team7' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>

                <!-- CANDIDATO 8 -->
                <li>
                    <!--RESUMEN OPORTUNIDAD-->
                    <section class="colab">
                        <!--ICONO-->
                        <figure>
                            <span class="icon-gTalents_team-48"></span>
                        </figure>

                        <div class="datos">
                            <h4>Andres Gonzalez</h4>
                            <p>Contador</p>
                        </div>
                    </section>

                    <!--OPCIONES-->
                    <div class="options">
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-button' href='#' data-activates='option-team8'>
                            <span class="icon-gTalents_submenu"></span>
                        </a>

                        <!-- Dropdown Structure -->
                        <ul id='option-team8' class='dropdown-content'>
                            <li><a href="#">Ver CV</a></li>
                            <li><a href="#">Aceptar</a></li>
                            <li><a href="#">Rechazar</a></li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!--PAGINADOR-->
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
            </ul>

        </div>
    </div>

    <!--MODAL PERFIL SUPPLIER-->
    <div id="modalProfileSupplier" class="modal modal-userRegistered">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Perfil del Supplier</h4>
        </div>

        <div class="modal-content">

            <!--RESUMEN SUPPLIER-->
            <div class="profile-colab profile-supplier">
                <section class="supplierContain1">
                    <!--ICONO RANGO-->
                    <figure class="supplierContain1-ranking">
                        <span class="icon-gTalents_rango-1"><span class="path1"></span><span class="path2"></span></span>
                    </figure>

                    <div class="datos">
                        <h4>QDT876</h4>
                        <p>Newbie</p>
                    </div>
                </section>

                <!--PROMEDIO CALIFICACIONES-->
                <div class="qualification">
                    <figure>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3"></span>
                        <span class="icon-gTalents_stars-3 star-null"></span>
                    </figure>
                </div>

                <!--RESUMEN 1-->
                <div class="profile-colab-message">
                    <h4>Ha participado en:</h4>
                    <p>214 oportunidades laborales</p>
                </div>

                <!--RESUMEN 2-->
                <div class="profile-colab-message">
                    <h4>Indice de aceptación de candidatos:</h4>
                    <p>90%</p>
                </div>
            </div>

            
            <!--BTN-MAIN-->
            <div class="item-btn">
                <a href="#!" class="btn-main">
                    Continuar
                </a>
            </div>
        </div>
    </div>

@stop

@section('scripts')
   
@stop
