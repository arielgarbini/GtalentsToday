@extends('layouts.app1')

@section('page-title', trans('app.dashboard'))

@section('content')

    @include('partials.admin-resume');

    <!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDADES-->
        <section class="user-main-create">

            <!--OPORTUNIDADES PUBLICADAS (POSTER) -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.as_poster')</h3>
                    <p>@lang('app.my_published_opportunities')</p>
                </section>

                @if (count($latestVacancies)) 
                    <ul class="credits-container post-list listado-post">
                        @foreach ($latestVacancies as $vacancy)
                            <!--POST 1 -->
                            <li>
                                <a href="{{route('vacancies.show',$vacancy->id)}}" class="link-listado">
                                    <!-- RESUMEN OPORTUNIDAD-->
                                    <section class="opportunity-admin">
                                        <!--DATOS DEL POST-->
                                        <div class="item-activity">
                                            @if(($vacancy->vacancy_status_id ==2 ) || ($vacancy->vacancy_status_id ==6 ))
                                            <p>{{trans('app.status')}}:  <span class="label label-{{ $vacancy->vacancy_status_id == 1 ? 'success':'warning' }}">
                                                {{ $vacancy->vacancy_status->getNameLang($vacancy->vacancy_status_id)->name }}
                                            </span></p>
                                            @else 
                                            <select class="browser-default">
                                                <option value="" disabled>Elige una opción</option>
                                                <option value="1" selected>Publicado</option>
                                                <option value="2">Pausado</option>
                                            </select>
                                            @endif
                                            <h2>{{$vacancy->name}}</h2>
                                            <h3>{{$vacancy->location}}|</h3>
                                            <h3>REF49</h3>
                                             <p>@lang('app.published') | {{ $vacancy->created_at->diffForHumans() }}</p>
                                        </div>

                                        <!--RESUMEN DEL POST-->
                                        <div class="item">
                                            <!--VISITAS-->
                                            <div class="item-option">
                                                <h4>47</h4>
                                                <span class="opt-sm">@lang('app.visits')</span>
                                            </div>

                                            <!--CANDIDATOS-->
                                            <div class="item-option">
                                                <h4>9</h4>
                                                <span class="opt-sm">@lang('app.candidates')</span>
                                            </div>

                                            <!--POR ACEPTAR-->
                                            <div class="item-option">
                                                <h4>3</h4>
                                                <span class="opt-sm">@lang('app.to_be_accepted')</span>
                                            </div>
                                        </div>
                                    </section>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                @else
                    <!--MENSAJE PARA DIV VACIO -->
                    <section class="messageGO">
                        <h3>@lang('app.no_activities_recorded')
                            <br><a href="{{route('vacancies.create')}}">@lang('app.create_a_job_opportunity')</a>
                        </h3>
                    </section>
                @endif

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

                <section class="view-more">
                    <a class="btn-viewMore">
                        @lang('app.see_more')
                    </a>
                </section>
            </div>

            <!--OPORTUNIDADES EN LAS QUE PARTICIPA (SUPPLIER)-->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.as_supplier')</h3>
                    <p>Candidatos Presentados</p>
                </section>

                @if (count($lastestOpportunities))
                    <ul class="credits-container post-list listado-post">
                        @foreach ($lastestOpportunities as $vacancy_opportunity)
                            <!--POST SUPPLIER -->
                            <li>
                                <a href="{{route('vacancies.post_user',$vacancy_opportunity->id)}}" class="link-listado">
                                    <!--RESUMEN OPORTUNIDAD-->
                                    <section class="opportunity-admin">
                                        <!--DATOS DEL POST-->
                                        <div class="item-activity">
                                            <h5>@lang('app.active')</h5>
                                            <h2>{{$vacancy_opportunity->name}}</h2>
                                            <h3>{{$vacancy_opportunity->location}} | </h3>
                                            <h3>REF49</h3>
                                           <p>@lang('app.published') | {{ $vacancy_opportunity->created_at->diffForHumans() }}</p>
                                           
                                            <!--SECCIONES TOOLTIPS-->
                                            <div class="item-activity-leyend">
                                                <!--FACTURACION APROXIMADA-->
                                                <div class="item">
                                                    
                                                </div>

                                                <!--CANTIDAD DE SUPPLIERS-->
                                                <div class="item">
                                                     <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                        <span class="icon-gTalents_comision"></span>
                                                     </a>
                                                </div>

                                                <!--CONTIGENCY O RETAINED-->
                                                <div class="item">
                                                     <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                        <span class="icon-gTalents_estado-post"></span>
                                                     </a>
                                                </div>
                                            </div>

                                        </div>

                                        <!--RESUMEN DEL POST-->
                                        <div class="item">
                                            <!--VISITAS-->
                                            <div class="item-option">
                                                <h4>47</h4>
                                                <span class="opt-sm">@lang('app.visits')</span>
                                            </div>

                                            <!--CANDIDATOS-->
                                            <div class="item-option">
                                                <h4>9</h4>
                                                <span class="opt-sm">@lang('app.candidates')</span>
                                            </div>

                                            <!--POR ACEPTAR-->
                                            <div class="item-option">
                                                <h4>3</h4>
                                                <span class="opt-sm">@lang('app.to_be_accepted')</span>
                                            </div>
                                        </div>
                                    </section>
                                </a>
                            </li>

                        @endforeach
                    </ul>
                @else
                    <!--MENSAJE PARA DIV VACIO -->
                    <section class="messageGO">
                        <h3>@lang('app.no_activities_recorded')
                            <br><a href="new-post.php">@lang('app.participate_in_an_opportunity')</a>
                        </h3>
                    </section>
                @endif

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

                <section class="view-more">
                    <a class="btn-viewMore">
                        <p>@lang('app.see_more')</p>
                    </a>
                </section>
            </div>

            <!--OPORTUNIDADES RECOMENDADAS-->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>Oportunidades Relevantes</h3>
                    <p>Te podrán interesar</p>
                </section>

                <ul class="credits-container post-list">
                    <!--POST RECOMENDADO 1-->
                    <li>
                        <a href="post-detail.php" class="link-listado">
                            <!--RESUMEN OPORTUNIDAD-->
                            <section class="opportunity-admin">
                                <!--DATOS DEL POST-->
                                <div class="item-activity">
                                    <h2>Desarrollador Ruby on Rails</h2>
                                    <h3>Buenos Aires, Argentina | REF49</h3>
                                    <p>Publicado | Jue,17 Nov 2016</p>
                                    <!--SECCIONES TOOLTIPS-->
                                    <div class="item-activity-leyend">
                                        <!--FACTURACION APROXIMADA-->
                                        <div class="item">
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
                                                <span class="icon-gTalents_facturacion"></span>
                                            </a>
                                        </div>

                                        <!--CANTIDAD DE SUPPLIERS-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                <span class="icon-gTalents_comision"></span>
                                             </a>
                                        </div>

                                        <!--CONTIGENCY O RETAINED-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                <span class="icon-gTalents_estado-post"></span>
                                             </a>
                                        </div>
                                    </div>

                                </div>

                                <!--RESUMEN DEL POST-->
                                <div class="item">
                                    <!--VISITAS-->
                                    <div class="item-option">
                                        <h4>47</h4>
                                        <span class="opt-sm">Visitas</span>
                                    </div>

                                    <!--CANDIDATOS-->
                                    <div class="item-option">
                                        <h4>9</h4>
                                        <span class="opt-sm">Candidatos</span>
                                    </div>

                                    <!--POR ACEPTAR-->
                                    <div class="item-option">
                                        <h4>3</h4>
                                        <span class="opt-sm">Por aceptar</span>
                                    </div>
                                </div>
                            </section>
                        </a>
                    </li>

                    <!--POST RECOMENDADO 2-->
                    <li>
                        <a href="post-detail.php" class="link-listado">
                            <!--RESUMEN OPORTUNIDAD-->
                            <section class="opportunity-admin">
                                <!--DATOS DEL POST-->
                                <div class="item-activity">
                                    <h2>Diseñador UX/UI</h2>
                                    <h3>Buenos Aires, Argentina | REF49</h3>
                                    <p>Publicado | Jue,17 Nov 2016</p>
                                    <!--SECCIONES TOOLTIPS-->
                                    <div class="item-activity-leyend">
                                        <!--FACTURACION APROXIMADA-->
                                        <div class="item">
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
                                                <span class="icon-gTalents_facturacion"></span>
                                            </a>
                                        </div>

                                        <!--CANTIDAD DE SUPPLIERS-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                <span class="icon-gTalents_comision"></span>
                                             </a>
                                        </div>

                                        <!--CONTIGENCY O RETAINED-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                <span class="icon-gTalents_estado-post"></span>
                                             </a>
                                        </div>
                                    </div>

                                </div>

                                <!--RESUMEN DEL POST-->
                                <div class="item">
                                    <!--VISITAS-->
                                    <div class="item-option">
                                        <h4>47</h4>
                                        <span class="opt-sm">Visitas</span>
                                    </div>

                                    <!--CANDIDATOS-->
                                    <div class="item-option">
                                        <h4>9</h4>
                                        <span class="opt-sm">Candidatos</span>
                                    </div>

                                    <!--POR ACEPTAR-->
                                    <div class="item-option">
                                        <h4>3</h4>
                                        <span class="opt-sm">Por aceptar</span>
                                    </div>
                                </div>
                            </section>
                        </a>
                    </li>

                    <!--POST RECOMENDADO 3-->
                    <li>
                        <a href="post-detail.php" class="link-listado">
                            <!--RESUMEN OPORTUNIDAD-->
                            <section class="opportunity-admin">
                                <!--DATOS DEL POST-->
                                <div class="item-activity">
                                    <h2>Desarrollador C#</h2>
                                    <h3>Buenos Aires, Argentina | REF49</h3>
                                    <p>Publicado | Jue,17 Nov 2016</p>
                                    <!--SECCIONES TOOLTIPS-->
                                    <div class="item-activity-leyend">
                                        <!--FACTURACION APROXIMADA-->
                                        <div class="item">
                                            <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Facturación Aproximada: $500">
                                                <span class="icon-gTalents_facturacion"></span>
                                            </a>
                                        </div>

                                        <!--CANTIDAD DE SUPPLIERS-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="6 Suppliers">
                                                <span class="icon-gTalents_comision"></span>
                                             </a>
                                        </div>

                                        <!--CONTIGENCY O RETAINED-->
                                        <div class="item">
                                             <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="Retained">
                                                <span class="icon-gTalents_estado-post"></span>
                                             </a>
                                        </div>
                                    </div>

                                </div>

                                <!--RESUMEN DEL POST-->
                                <div class="item">
                                    <!--VISITAS-->
                                    <div class="item-option">
                                        <h4>47</h4>
                                        <span class="opt-sm">Visitas</span>
                                    </div>

                                    <!--CANDIDATOS-->
                                    <div class="item-option">
                                        <h4>9</h4>
                                        <span class="opt-sm">Candidatos</span>
                                    </div>

                                    <!--POR ACEPTAR-->
                                    <div class="item-option">
                                        <h4>3</h4>
                                        <span class="opt-sm">Por aceptar</span>
                                    </div>
                                </div>
                            </section>
                        </a>
                    </li>
                </ul>

                <section class="view-more">
                    <a href="post-list.php">
                        <p>ver más</p>
                    </a>
                </section>
            </div>
        </section>

        <!--NOTIFICACIONES - EQUIPO - PUNTAJE-->
        <section class="user-main-contain">
            <!-- NOTIFICACIONES -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.alerts')</h3>
                </section>
               
                <!--ALERTAS-->
                <ul class="alerts-div">
                    <!--ALERTA 0-->
                <!-- Request Suppliers - request Candidats -->
               @if(count($notifications)>0)
                        @foreach($notifications as $notification)
                            @if($notification->type=='request_supplier_vacancy')
                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('vacancies.show',$notification->post_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title}}</h4>
                                                <p>{{$notification->message}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--ACEPTAR-->
                                    <form action="{{route('vacancies.approbate.supplier',$notification->post_id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$notification->id}}" name="notification">
                                        <span class="icon-gTalents_win-53 acept-alert send_form"></span>
                                    </form>
                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('vacancies.reject.supplier',$notification->post_id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$notification->id}}" name="notification">
                                        <input type="hidden" value="{{$notification->supplier_id}}" name="supplier">
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>
                            @elseif($notification->type=='approved_supplier_vacancy' || $notification->type=='rejected_supplier_vacancy')

                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('vacancies.post_user',$notification->element_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title}}</h4>
                                                <p>{{$notification->message}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>
                            @endif
                        @endforeach

                    @else
                           <li>{{trans('app.no_notifications')}}</li>
                    @endif
                    </ul>
                    <!--ALERTA 1-->
                    <!--<li>
                        <div class="motivo">
                            <a href="#">
                                <figure>
                                    <span class="icon-gTalents_point"></span>
                                </figure>
                                <div class="datos">
                                    <h4>¡Nuevo Candidato!</h4>
                                    <p>Desarrollador .NET</p>
                                </div>
                            </a>
                        </div>-->
                        <!--BTN ELIMINAR -->
                        <!--<span class="icon-gTalents_close close-alert"></span>
                    </li>-->

                    <!--ALERTA 2-->
                    <!--<li>
                        <div class="motivo">
                            <a href="#">
                                <figure>
                                    <span class="icon-gTalents_point"></span>
                                </figure>
                                <div class="datos">
                                    <h4>¡Nuevo Candidato!</h4>
                                    <p>Desarrollador .NET</p>
                                </div>
                            </a>
                        </div-->
                        <!--BTN ELIMINAR -->
                      <!--  <span class="icon-gTalents_close close-alert"></span>
                    </li>-->

                    <!--ALERTA 3-->
                    <!--<li>
                        <div class="motivo">
                            <a href="#">
                                <figure>
                                    <span class="icon-gTalents_point"></span>
                                </figure>
                                <div class="datos">
                                    <h4>¡Nuevo Candidato!</h4>
                                    <p>Desarrollador .NET</p>
                                </div>
                            </a>
                        </div>-->
                        <!--BTN ELIMINAR -->
                        <!--<span class="icon-gTalents_close close-alert"></span>
                    </li>-->

                    <!--ALERTA 4-->
                    <!--<li>
                        <div class="motivo">
                            <a href="#">
                                <figure>
                                    <span class="icon-gTalents_point"></span>
                                </figure>
                                <div class="datos">
                                    <h4>¡Nuevo Candidato!</h4>
                                    <p>Desarrollador .NET</p>
                                </div>
                            </a>
                        </div>-->
                        <!--BTN ELIMINAR -->
                        <!--<span class="icon-gTalents_close close-alert"></span>
                    </li>-->

                    <!--ALERTA 5-->
                    <!--<li>
                        <div class="motivo">
                            <a href="#">
                                <figure>
                                    <span class="icon-gTalents_point"></span>
                                </figure>
                                <div class="datos">
                                    <h4>¡Nuevo Candidato!</h4>
                                    <p>Desarrollador .NET</p>
                                </div>
                            </a>
                        </div>-->
                        <!--BTN ELIMINAR -->
                        <!--<span class="icon-gTalents_close close-alert"></span>
                    </li>   -->
                               
            </div>

            <!-- LISTADO EQUIPOS Y CANDIDATOS -->
            <div class="user-main-contain-resumTeam no-mobile">
                <ul class="tabs">
                    <li class="tab">
                        <a class="active" href="#myTeam">@lang('app.my_team')</a>
                    </li>
                    <li class="tab">
                        <a href="#myCandidates">@lang('app.my_candidates')</a>
                    </li>
                </ul>

                <!--MI EQUIPO-->
                <div class="team-container" id="myTeam">
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
                    
                    <!--LISTADO DE EQUIPO-->
                    <ul class="team">
                        <!-- COLABORADOR 1 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
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
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 2 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team02'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team02' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 3 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team03'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team03' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 4 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team04'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team04' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 5 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team05'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team05' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 6 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team06'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team06' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewTeam" class="modal-trigger waves-effect waves-light">
                            <p>Nuevo Colaborador</p>
                        </a>
                    </section>
                </div>

                <!-- MIS CANDIDATOS -->
                <div class="team-container" id="myCandidates">
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
                                        <span class="icon-gTalents_ejecutive"></span>
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
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
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
                                        <span class="icon-gTalents_ejecutive"></span>
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
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
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
                                        <span class="icon-gTalents_ejecutive"></span>
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
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
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
                                        <span class="icon-gTalents_ejecutive"></span>
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
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
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
                                        <span class="icon-gTalents_ejecutive"></span>
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
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
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
                                        <span class="icon-gTalents_ejecutive"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Ayudante de Cocina</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team6'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team6' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewCandidato" class="modal-trigger waves-effect waves-light">
                            <p>Nuevo Candidato</p>
                        </a>
                    </section>
                </div>
            </div>

      

            <!-- RANGO Y PUNTAJE -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.position_of_my_Profile')</h3>
                </section>

                <!--RANGO-->
                <section class="ranking">
                    <!--RANGO A-->
                    <figure>
                        <span class="icon-gTalents_rango-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    </figure>

                    <!--RANGO B -->
                    <figure>
                        <span class="icon-gTalents_rango-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                    </figure>

                    <!--RANGO C -->
                    <figure>
                        <span class="icon-gTalents_rango-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                    </figure>

                    <!--RANGO D -->
                    <figure class="ranking-active">
                        <span class="icon-gTalents_rango-8"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span><span class="path9"></span><span class="path10"></span><span class="path11"></span><span class="path12"></span><span class="path13"></span></span>
                    </figure>
                </section>

                <!--RESUMEN-->
                <section class="position-resum">
                    <!--POSICION-->
                    <div class="item">
                        <h4>@lang('app.my_position')</h4>
                        <p><strong>{{ Auth::user()->category->name }}</strong></p>
                    </div>

                    <!--PUNTAJE-->
                    <div class="item">
                        <h4>@lang('app.i_lack')</h4>
                        <p><strong>{{ Auth::user()->category->nextLevel() }}pts</strong> @lang('app.next_level')</p>
                    </div>
                </section>
            </div>
        </section>
    </article>

    <!--EQUIPO Y CANDIDATOS MOBILE-->
    <article class="team-mobile">
        <!--BOTON-->
        <a class="team-mobile-btn" id="btn-teamMobile">
            <span class="icon-gTalents_ejecutive"></span>
        </a>

        <!--TEAM GROUP-->
        <section class="team-mobile-container" id="teamMobile-container">
            <!-- LISTADO EQUIPOS Y CANDIDATOS -->
            <div class="user-main-contain-resumTeam">
                <ul class="tabs">
                    <li class="tab">
                        <a class="active" href="#myTeam2">Mi equipo</a>
                    </li>
                    <li class="tab">
                        <a href="#myCandidates2">Mis Candidatos</a>
                    </li>
                </ul>

                <!--MI EQUIPO-->
                <div class="team-container" id="myTeam2">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>22 Colaboradores</p>

                            <div class="search-opt1">
                                <span class="icon-gTalents_search" id="btn-search2"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="Nombre del Colaborador">
                            <!--CERRAR SEGMENTO-->
                            <div class="close" id="btn-closeInput2">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <ul class="team">
                        <!-- COLABORADOR 1 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team1'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team1' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 2 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team2'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team2' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 3 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team3'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team3' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 4 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team4'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team4' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 5 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team5'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team5' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>

                        <!-- COLABORADOR 6 -->
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>Andres Gonzalez</h3>
                                        <p>Básico</p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='option-team6'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='option-team6' class='dropdown-content'>
                                        <li><a href="#">Editar</a></li>
                                        <li><a href="#">Eliminar</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#">
                            <p>Nuevo Colaborador</p>
                        </a>
                    </section>
                </div>

                <!-- MIS CANDIDATOS -->
                <div class="team-container" id="myCandidates2">
                    Test 2
                </div>
            </div>
        </section>
    </article>

    <!--MODAL NUEVO COLABORADOR-->
    <div id="modalNewTeam" class="modal modal-userRegistered modal-fixed-footer">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Nuevo Colaborador</h4>
        </div>

        <div class="modal-content">
            <form action="" class="formLogin">
                <!--NOMBRE-->
                <div class="itemForm">
                    <label>Nombre</label>
                    <input type="text" placeholder="Nombre">
                    <span>Nombre inválido</span>
                </div>

                <!--APELLIDO-->
                <div class="itemForm">
                    <label>Nombre</label>
                    <input type="text" placeholder="Apellido">
                    <span>Apellido inválido</span>
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    <label>Correo Electrónico</label>
                    <input type="email" placeholder="Correo Electrónico">
                    <span>Correo electrónico inválido</span>
                </div>

                <!--PREFIJO-->
                <div class="itemForm icon-help">
                    <label>Nivel de Acceso</label>

                    <a class="hint--right  hint--large hint--bounce" aria-label="You can show very very long sentences inside tooltips by using various available size variation classes.">
                        <i class="icon-gTalents_help "></i>
                    </a>

                    <select class="browser-default">
                        <option value="" disabled selected>Elige un tipo de Acceso</option>
                        <option value="1">Administrador</option>
                        <option value="2">Poster</option>
                        <option value="3">Novato</option>
                    </select>
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
                <p>Nuevo colaborador agregado exitosamente</p>
                <!--BTN-MAIN-->
                <div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--MODAL NUEVO CANDIDATO-->
    <div id="modalNewCandidato" class="modal modal-userRegistered modal-fixed-footer">
        
        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>Nuevo Candidato</h4>
        </div>

        <div class="modal-content">
            <form action="" class="formLogin">
                
                <div class="dual">
                    <!--NOMBRE-->
                    <div class="itemForm">
                        <label>Nombre</label>
                        <input type="text" placeholder="Nombre">
                        <span>Nombre inválido</span>
                    </div>

                    <!--APELLIDO-->
                    <div class="itemForm">
                        <label>Nombre</label>
                        <input type="text" placeholder="Apellido">
                        <span>Apellido inválido</span>
                    </div>
                </div>

                <!--TELEFONO-->
                <div class="itemForm">
                    <label>Teléfono</label>
                    <input id="phone" type="tel">
                </div>

                <!--CORREO ELECTRONICO-->
                <div class="itemForm">
                    <label>Correo Electrónico</label>
                    <input type="email" placeholder="Correo Electrónico">
                    <span>Correo electrónico inválido</span>
                </div>

                <!--POSICION ACTUAL-->
                <div class="itemForm">
                    <label>Posición actual o más reciente</label>
                    <input type="text" placeholder="UX/UI Designer">
                </div>

                <!--COMPAÑIA ACTUAL-->
                <div class="itemForm">
                    <label>Compañia actual</label>
                    <input type="text" placeholder="Platzi">
                </div>

                <div class="dual">
                    <!--PAIS-->
                    <div class="itemForm">
                        <label>Pais</label>
                        <input type="text" placeholder="Venezuela">
                    </div>

                    <!--COMPENSACION-->
                    <div class="itemForm">
                        <label>Compensación</label>
                        <select class="browser-default">
                            <option value="" disabled>Elige un rango</option>
                            <option value="1" selected>USD 60k-70k</option>
                            <option value="2">USD 40k-50k</option>
                            <option value="3">USD 30k-40k</option>
                        </select>
                    </div>
                </div>

                <!--BOTONES UPLOAD-->
                <div class="upload">
                    <!-- DESCRIPCION DEL PUESTO -->
                    <div class="box">
                        <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Adjuntar CV</span></label>
                    </div>
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
                <p>Nuevo candidato agregado exitosamente</p>
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
  <!--  <script>
        var labels = {!! json_encode(array_keys($activities)) !!};
        var activities = {!! json_encode(array_values($activities)) !!};
    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-default.js') !!}-->
@stop