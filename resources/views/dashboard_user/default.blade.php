@extends('layouts.app1')

@section('page-title', trans('app.dashboard'))

@section('content')

    @include('partials.admin-resume');

    <style>
        .country-list{
            width: 400px !important;
        }
        .intl-tel-input{
            width: 100% !important;
        }
    </style>
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
                    <ul class="credits-container post-list listado-post" id="latesVacanciesPoster">
                        @foreach ($latestVacancies as $vacancy)
                            <!--POST 1 -->
                            <li class="">
                                <a href="{{route('vacancies.show',$vacancy->id)}}" class="link-listado">
                                    <!-- RESUMEN OPORTUNIDAD-->
                                    <section class="opportunity-admin">
                                        <!--DATOS DEL POST-->
                                        <div class="item-activity">
                                            @if(($vacancy->vacancy_status_id ==2 ) || ($vacancy->vacancy_status_id ==6 ) || ($vacancy->vacancy_status_id ==4 ) || ($vacancy->vacancy_status_id ==8 ))
                                            <p>{{trans('app.status')}}:  <span class="label label-{{ $vacancy->vacancy_status_id == 1 ? 'success':'warning' }}">
                                                {{ $vacancy->vacancy_status->getNameLang($vacancy->vacancy_status_id)->name }}
                                            </span></p>
                                            @else 
                                            <select class="change-status browser-default" value="{{$vacancy->id}}">
                                                <option value="" disabled>@lang('app.choose_an_option')</option>
                                                <option value="1" selected>@lang('app.published')</option>
                                                <option value="2">@lang('app.paused')</option>
                                                <option value="4">@lang('app.close')</option>
                                                <option value="edit">@lang('app.edit')</option>
                                            </select>
                                            @endif
                                            <h2>{{$vacancy->name}}</h2>
                                            <h3>{{substr($vacancy->locat->country->name.' | '.$vacancy->locat->name, 0, 25)}} @if(strlen($vacancy->locat->country->name.' | '.$vacancy->locat->name)>25) ... @endif</h3>
                                            <p>@lang('app.published') | {{ $vacancy->created_at->diffForHumans() }}</p>
                                            <h3>@if($vacancy->search_type==1) {{trans('app.contingency')}} @else {{trans('app.retained')}} @endif</h3>
                                        </div>

                                        <!--RESUMEN DEL POST-->
                                        <div class="item">
                                            <!--VISITAS-->
                                            <div class="item-option">
                                                <h5 class="h4Bold">{{count($vacancy->activeSuppliers())}}</h5>
                                                <span class="opt-sm">Suppliers</span>
                                            </div>

                                            <!--CANDIDATOS-->
                                            <div class="item-option">
                                                <h5 class="h4Bold">{{$vacancy->countCandidatesByStatus('Active')}}</h5>
                                                <span class="opt-sm">@lang('app.candidates')</span>
                                            </div>

                                            <!--POR ACEPTAR-->
                                            <div class="item-option">
                                                <h5 class="h4Bold">{{$vacancy->countCandidatesByStatus('Unconfirmed')}}</h5>
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
                @if($latestVacanciesPages>1)
                    <ul class="pagination" data-pages="{{$latestVacanciesPages}}" data-element="latesVacanciesPoster" data-resource="{{route('vacancies.get.poster')}}" data-count="{{$latestVacanciesCount}}" data-page="1">
                        <li class="disabled" data-page="last"><span>«</span></li>
                        <li class="active page-1" data-page="1" ><span>1</span></li>
                        @for($j = 2; $j<=$latestVacanciesPages; $j++)
                            <li data-page="{{$j}}" class="page-{{$j}}"><span>{{$j}}</span></li>
                        @endfor
                        <li class="disabled" data-page="next"><span>»</span></li>
                    </ul>
                @endif

                @if(count($latestVacancies) > 2)
                    <section class="view-more">
                        <a class="btn-viewMore">
                            <p>@lang('app.see_more')</p>
                        </a>
                    </section>
                @endif
            </div>

            <!--OPORTUNIDADES EN LAS QUE PARTICIPA (SUPPLIER)-->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.as_supplier')</h3>
                    <p>@lang('app.featured_candidates')</p>
                </section>

                @if (count($vacancies_users))
                    <ul class="credits-container post-list listado-post" id="latesVacanciesUser">
                        @foreach ($vacancies_users as $vacancy_opportunity)
                            <!--POST SUPPLIER -->
                            <li class="">
                                <a href="{{route('vacancies.post_user',$vacancy_opportunity->id)}}" class="link-listado">
                                    <!--RESUMEN OPORTUNIDAD-->
                                    <section class="opportunity-admin">
                                        <!--DATOS DEL POST-->
                                        <div class="item-activity">
                                            <h5>@lang('app.active')</h5>
                                            <h2>@if(strlen($vacancy_opportunity->name)>=28)
                                                    {{substr($vacancy_opportunity->name,0,28)}}...
                                                @else
                                                    {{$vacancy_opportunity->name}}
                                                @endif
                                            </h2>
                                            <h3>{{substr($vacancy_opportunity->locat->country->name.' | '.$vacancy_opportunity->locat->name, 0, 25)}} @if(strlen($vacancy_opportunity->locat->country->name.' | '.$vacancy_opportunity->locat->name)>25) ... @endif</h3>
                                            <p>@lang('app.published') | {{ $vacancy_opportunity->created_at->diffForHumans() }}</p>
                                            <h3>@if($vacancy_opportunity->search_type==1) {{trans('app.contingency')}} @else {{trans('app.retained')}} @endif</h3>
                                        </div>

                                        <!--RESUMEN DEL POST-->
                                        <div class="item">
                                            <!--FACTURACION APROXIMADA-->
                                            <?php
                                                try{
                                                    preg_match_all('/\d{1,2}/' ,$vacancy_opportunity->range_salary, $matches);
                                                    $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                                                    $factur = number_format($factur, 2, '.', ',');
                                                } catch(\exception $e){
                                                    $factur = '';
                                                }
                                            ?>
                                            <div class="item-option">
                                                <h5 class="h4Bold">${{$factur}}</h5>
                                                <span class="opt-sm tamano">{{trans('app.approximate_billing')}}</span>
                                            </div>

                                            <!--CANDIDATOS-->
                                            <div class="item-option">
                                                <h5 class="h4Bold">{{$vacancy_opportunity->countCandidatesByStatus('Active')}}</h5>
                                                <span class="opt-sm tamano">@lang('app.candidates')</span>
                                            </div>

                                            <!--CANTIDAD DE SUPPLIERS  --> 
                                            <div class="item-option">
                                                <h5 class="h4Bold">{{count($vacancy_opportunity->activeSuppliers())}}</h5>
                                                <span class="opt-sm tamano">Suppliers</span>
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
                            <br><a href="{{route('vacancies.list')}}">@lang('app.participate_in_an_opportunity')</a>
                        </h3>
                    </section>
                @endif

                @if($vacancies_users_pages>1)
                    <ul class="pagination" data-pages="{{$vacancies_users_pages}}" data-element="latesVacanciesUser" data-resource="{{route('vacancies.get.user')}}" data-count="{{$vacancies_users_count}}" data-page="1">
                        <li class="disabled" data-page="last"><span>«</span></li>
                        <li class="active page-1" data-page="1" ><span>1</span></li>
                        @for($j = 2; $j<=$vacancies_users_pages; $j++)
                            <li data-page="{{$j}}" class="page-{{$j}}"><span>{{$j}}</span></li>
                        @endfor
                        <li class="disabled" data-page="next"><span>»</span></li>
                    </ul>
                @endif

                @if(count($vacancies_users) > 2)
                <section class="view-more">
                    <a class="btn-viewMore">
                        <p>@lang('app.see_more')</p>
                    </a>
                </section>
                @endif
            </div>

            <!--OPORTUNIDADES RECOMENDADAS-->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.relevant_opportunities')</h3>
                    <p>@lang('app.interesting_opportunities')</p>
                </section>
                <ul class="credits-container post-list">
                    <!--POST RECOMENDADO 1-->
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
                                        <h3>{{substr($vacancy_opportunity->locat->country->name.' | '.$vacancy_opportunity->locat->name, 0, 25)}} @if(strlen($vacancy_opportunity->locat->country->name.' | '.$vacancy_opportunity->locat->name)>25) ... @endif</h3>
                                        <p>@lang('app.published') | {{ $vacancy_opportunity->created_at->diffForHumans() }}</p>

                                        <!--SECCIONES TOOLTIPS-->
                                        <div class="item-activity-leyend">
                                            <!--FACTURACION APROXIMADA-->
                                            <?php
                                                try{
                                                    preg_match_all('/\d{1,2}/' ,$vacancy_opportunity->range_salary, $matches);
                                                    $factur = (intval($matches[0][0].'000')+intval($matches[0][1].'000'))/2;
                                                    $factur = number_format($factur, 2, '.', ',');
                                                } catch(\exception $e){
                                                    $factur = '';
                                                }
                                            ?>
                                            <div class="item">
                                                <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="{{trans('app.approximate_billing')}}: ${{$factur}}">
                                                    <span class="icon-gTalents_facturacion"></span>
                                                </a>
                                            </div>
                                            <!--CANTIDAD DE SUPPLIERS-->
                                            <div class="item">
                                                <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="{{count($vacancy_opportunity->activeSuppliers())}} Suppliers">
                                                    <span class="icon-gTalents_comision"></span>
                                                </a>
                                            </div>

                                            <!--CONTIGENCY O RETAINED-->
                                            <div class="item">
                                                <a class="tooltipped" data-position="bottom" data-delay="50" data-tooltip="@if($vacancy_opportunity->search_type==1) {{trans('app.contingency')}} @else {{trans('app.retained')}} @endif">
                                                    <span class="icon-gTalents_estado-post"></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <!--RESUMEN DEL POST-->
                                    <div class="item">
                                        <!--VISITAS-->
                                        <div class="item-option">
                                            <h4><?php echo $viewed->search(['vacancy_id' => $vacancy_opportunity->id])->count() ?></h4>
                                            <span class="opt-sm">@lang('app.visits')</span>
                                        </div>

                                        <!--CANDIDATOS-->
                                        <div class="item-option">
                                            <h4>{{$vacancy_opportunity->countCandidatesByStatus('Active')}}</h4>
                                            <span class="opt-sm">@lang('app.candidates')</span>
                                        </div>

                                        <!--POR ACEPTAR-->
                                        <div class="item-option">
                                            <h4>{{$vacancy_opportunity->countCandidatesByStatus('Unconfirmed')}}</h4>
                                            <span class="opt-sm">@lang('app.to_be_accepted')</span>
                                        </div>
                                    </div>
                                </section>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <section class="view-more">
                    <a href="{{route('vacancies.list')}}">
                        <p>@lang('app.see_more')</p>
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
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
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
                            @elseif($notification->type=='invited_supplier_vacancy')
                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('vacancies.show',$notification->element_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--ACEPTAR-->
                                    <form action="{{route('vacancies.approbate.supplier.invited',$notification->element_id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$notification->id}}" name="notification">
                                        <input type="hidden" value="{{$notification->user_id}}" name="supplier">
                                        <span class="icon-gTalents_win-53 acept-alert send_form"></span>
                                    </form>
                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('vacancies.reject.supplier.invited',$notification->element_id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$notification->id}}" name="notification">
                                        <input type="hidden" value="{{$notification->user_id}}" name="supplier">
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>
                            @elseif($notification->type=='approved_supplier_vacancy' || $notification->type=='rejected_supplier_vacancy' || $notification->type=='approbate_supplier_candidate' || $notification->type=='rejected_supplier_candidate')

                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('vacancies.post_user',$notification->element_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>

                            @elseif($notification->type=='approved_supplier_invited_vacancy' || $notification->type=='rejected_supplier_invited_vacancy')
                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('vacancies.show',$notification->element_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>

                            @elseif($notification->type=='request_supplier_candidates')
                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('vacancies.show',$notification->element_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>
                                @elseif($notification->type=='message_received')
                                    <li class="alert-participar">
                                        <div class="motivo">
                                            <a href="{{route('message.indexFrontend')}}">
                                                <figure>
                                                    <span class="icon-gTalents_point"></span>
                                                </figure>
                                                <div class="datos">
                                                    <h4>{{$notification->title_traduccion}}</h4>
                                                    <p>{{$notification->message_traduccion}}</p>
                                                </div>
                                            </a>
                                        </div>

                                        <!--BTN ELIMINAR -->
                                        <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                            {{csrf_field()}}
                                            <span class="icon-gTalents_close close-alert send_form"></span>
                                        </form>
                                    </li>
                                @elseif($notification->type=='qualify_supplier_vacancy')
                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('califications.index')}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>
                                @elseif($notification->type=='qualify_supplier_vacancy_contract')
                                <li class="alert-participar">
                                    <div class="motivo">
                                        <a href="{{route('supplier.calification_supplier', $notification->element_id)}}">
                                            <figure>
                                                <span class="icon-gTalents_point"></span>
                                            </figure>
                                            <div class="datos">
                                                <h4>{{$notification->title_traduccion}}</h4>
                                                <p>{{$notification->message_traduccion}}</p>
                                            </div>
                                        </a>
                                    </div>

                                    <!--BTN ELIMINAR -->
                                    <form action="{{route('notifications.delete',$notification->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <span class="icon-gTalents_close close-alert send_form"></span>
                                    </form>
                                </li>
                                @elseif($notification->type=='get_points' || $notification->type=='promotion_received' || $notification->type=='vacancy_change_status_paused' || $notification->type=='vacancy_change_status_closed')
                                    <li class="alert-participar">
                                        <div class="motivo">
                                            <a href="{{route('dashboard')}}">
                                                <figure>
                                                    <span class="icon-gTalents_point"></span>
                                                </figure>
                                                <div class="datos">
                                                    <h4>{{$notification->title_traduccion}}</h4>
                                                    <p>{{$notification->message_traduccion}}</p>
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
                                <li class="ClassFechaCampana right-align">
                                    <div class="motivo">
                                        <div class="datos">
                                            <p>{{$notification->created_at->diffForHumans()}}</p>
                                        </div>
                                    </div>
                                </li>
                        @endforeach
                    @else
                           <li>{{trans('app.no_notifications')}}</li>
                    @endif
                    </ul>
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
                            <p>{{count($team)}} @lang('app.team')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.collaborator_name')}}" id="search-supplier">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <ul class="team" id="list-supplier">
                        <!-- COLABORADOR 1 -->
                        @foreach($team as $te)
                            <li>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_team-48"></span>
                                        </figure>
                                        <div class="datos">
                                            <h3>{{substr($te->user->first_name.' '.$te->user->last_name, 0, 20)}}</h3>
                                            <p>
                                                @if($te->is_active)
                                                    @lang('app.active')
                                                @else
                                                    @lang('app.inactive')
                                                @endif
                                                -
                                                @if($te->position == 1)
                                                    @lang('app.administrator')
                                                @elseif($te->position == 2)
                                                    @lang('app.User')
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='collaborator{{$te->id}}'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='collaborator{{$te->id}}' class='dropdown-content'>
                                            <li><a href="#modalEditarcollaborator{{$te->id}}">@lang('app.edit')</a></li>
                                            <li><a href="#modalEliminarcollaborator{{$te->id}}">@lang('app.delete')</a></li>
                                        </ul>
                                        <?php
                                        $modal = 'collaborator'.$te->id ?>
                                        @include('dashboard_user.team.partials.modaldelete')
                                        @include('dashboard_user.team.partials.modaledit')
                                    </div>
                                </section>
                            </li>
                        @endforeach
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewTeam" class="modal-trigger waves-effect waves-light">
                            <p>@lang('app.new_collaborator')</p>
                        </a>
                    </section>
                </div>

                <!-- MIS CANDIDATOS -->
                <div class="team-container" id="myCandidates">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($candidates)}} @lang('app.candidates')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.candidate_name')}}" id="search-candidates">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team" id="list-candidates">
                        <!-- CANDIDATO 1 -->
                        @foreach($candidates as $candidate)
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_ejecutive"></span>
                                    </figure>
                                    <div class="datos">
                                        @if((strlen($candidate['first_name']) + strlen($candidate['last_name'])) > 15)
                                            <?php $name = $candidate['first_name'].' '.$candidate['last_name'] ?>
                                            <h3>{{substr($name, 0, 15)}}...</h3>
                                        @else
                                            <h3>{{$candidate['first_name']}} {{$candidate['last_name']}}</h3>
                                        @endif
                                        <p>{{substr($candidate['actual_position'],0, 20)}}</p>
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
                                        <li><a href="#modalEditar{{$candidate['id']}}tt">@lang('app.edit')</a></li>
                                        <li><a href="#modalEliminar{{$candidate['id']}}tt">@lang('app.delete')</a></li>
                                    </ul>
                                    <?php
                                    $dataFile = 'update-'.$candidate['id'];
                                    $cand = $candidate['id'].'tt';
                                    ?>
                                    @include('dashboard_user.candidate.partials.modaldelete')
                                    @include('dashboard_user.candidate.partials.modaledit')
                                </div>
                            </section>
                        </li>
                        @endforeach
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewCandidato" class="modal-trigger waves-effect waves-light">
                            <p>@lang('app.new_candidate')</p>
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
                    <figure class="ranking-active">
                        <span class="icon-gTalents_rango-{{Auth::user()->company[0]->category_id}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                    </figure>

                    @for($i=1; $i<=3; $i++)
                        @if(Auth::user()->company[0]->category_id+$i <= 8)
                        <!--RANGO B -->
                            <figure>
                                <span class="icon-gTalents_rango-{{Auth::user()->company[0]->category_id+$i}}"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                            </figure>
                        @endif
                    @endfor
                </section>

                <!--RESUMEN-->
                <section class="position-resum">
                    <!--POSICION-->
                    <div class="item">
                        <h4>@lang('app.my_position')</h4>
                        <p><strong><?php echo Auth::user()->company[0]->category->name; ?></strong></p>
                    </div>

                    <!--PUNTAJE-->
                    <div class="item">
                        <h4>@lang('app.i_lack')</h4>
                        <p><strong>{{ Auth::user()->company[0]->category->nextLevel() }}pts</strong> @lang('app.next_level')</p>
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
                        <a class="active" href="#myTeam2">@lang('app.my_team')</a>
                    </li>
                    <li class="tab">
                        <a href="#myCandidates2">@lang('app.my_candidates')</a>
                    </li>
                </ul>

                <!--MI EQUIPO-->
                <div class="team-container" id="myTeam2">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($team)}} @lang('app.collaborators')</p>

                            <div class="search-opt1">
                                <span class="icon-gTalents_search" id="btn-search2"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.collaborator_name')}}" id="search-supplier-m">
                            <!--CERRAR SEGMENTO-->
                            <div class="close" id="btn-closeInput2">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <ul class="team" id="list-supplier-m">
                        <!-- COLABORADOR 1 -->
                        @foreach($team as $te)
                        <li>
                            <section class="team-card">
                                <!--PERSONA-->
                                <div class="team-card-person">
                                    <figure>
                                        <span class="icon-gTalents_team-48"></span>
                                    </figure>
                                    <div class="datos">
                                        <h3>{{substr($te->user->first_name.' '.$te->user->last_name, 0, 20)}}</h3>
                                        <p>
                                            @if($te->is_active)
                                                @lang('app.active')
                                            @else
                                                @lang('app.inactive')
                                            @endif
                                            -
                                            @if($te->position == 1)
                                                @lang('app.administrator')
                                            @elseif($te->position == 2)
                                                @lang('app.User')
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!--OPCIONES-->
                                <div class="options">
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-button' href='#' data-activates='{{$te->id}}'>
                                        <span class="icon-gTalents_submenu"></span>
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='{{$te->id}}' class='dropdown-content'>
                                        <li><a href="#modalEditarmobil{{$te->id}}">@lang('app.edit')</a></li>
                                        <li><a href="#modalEliminarmobil{{$te->id}}">@lang('app.delete')</a></li>
                                    </ul>
                                    <?php
                                    $modal = 'mobil'.$te->id ?>
                                    @include('dashboard_user.team.partials.modaldelete')
                                    @include('dashboard_user.team.partials.modaledit')
                                </div>
                            </section>
                        </li>
                        @endforeach
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewTeam">
                            <p>@lang('app.new_collaborator')</p>
                        </a>
                    </section>
                </div>

                <!-- MIS CANDIDATOS -->
                <div class="team-container" id="myCandidates2">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($candidates)}} @lang('app.candidates')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.candidate_name')}}" id="search-candidates-m">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>
                        </form>
                    </section>

                    <!--LISTADO DE CANDIDATOS-->
                    <ul class="team" id="list-candidates-m">
                        <!-- CANDIDATO 1 -->
                        @foreach($candidates as $candidate)
                            <li>
                                <section class="team-card">
                                    <!--PERSONA-->
                                    <div class="team-card-person">
                                        <figure>
                                            <span class="icon-gTalents_ejecutive"></span>
                                        </figure>
                                        <div class="datos">
                                            @if((strlen($candidate['first_name']) + strlen($candidate['last_name'])) > 15)
                                                <?php $name = $candidate['first_name'].' '.$candidate['last_name'] ?>
                                                <h3>{{substr($name, 0, 15)}}...</h3>
                                            @else
                                                <h3>{{$candidate['first_name']}} {{$candidate['last_name']}}</h3>
                                            @endif
                                            <p>{{substr($candidate['actual_position'],0, 20)}}</p>
                                        </div>
                                    </div>

                                    <!--OPCIONES-->
                                    <div class="options">
                                        <!-- Dropdown Trigger -->
                                        <a class='dropdown-button' href='#' data-activates='option-colbb{{$candidate['id']}}'>
                                            <span class="icon-gTalents_submenu"></span>
                                        </a>

                                        <!-- Dropdown Structure -->
                                        <ul id='option-colbb{{$candidate['id']}}' class='dropdown-content'>
                                            <li><a href="#modalEditar{{$candidate['id']}}mobill">@lang('app.edit')</a></li>
                                            <li><a href="#modalEliminar{{$candidate['id']}}mobill">@lang('app.delete')</a></li>
                                        </ul>
                                        <?php
                                            $dataFile = 'update-mobil'.$candidate['id'];
                                            $cand = $candidate['id'].'mobill';
                                        ?>
                                        @include('dashboard_user.candidate.partials.modaldelete')
                                        @include('dashboard_user.candidate.partials.modaledit')
                                    </div>
                                </section>
                            </li>
                        @endforeach
                    </ul>

                    <!--AGREGAR NUEVO COLABORADOR -->
                    <section class="new-team">
                        <a href="#modalNewCandidato" class="modal-trigger waves-effect waves-light">
                            <p>@lang('app.new_candidate')</p>
                        </a>
                    </section>
                </div>
            </div>
        </section>
    </article>


    <div id="modalChangeStatus" class="modal modal-userRegistered">

        <div class="modal-header">
            <!--CERRAR MODAL-->
            <div class="close">
                <a href="#!" class="modal-action modal-close">
                    <span class="icon-gTalents_close-2"></span>
                </a>
            </div>

            <h4>@lang('app.write_your_reasons')</h4>
        </div>

        <div class="modal-content">
            <form action="{{route('vacancies.change_status')}}" role='form' method="POST" id="formCreate" class="formLogin">
                <!--NOMBRE-->
                {{csrf_field()}}
                <input type="hidden" id="status_change" name="status">
                <input type="hidden" id="vacancy_change" name="vacancy">
                <div class="itemForm icon-help">
                    <label>@lang('app.to_supplier')</label>
                    <textarea name="message_supplier" id="message_supplier" cols="30" rows="10" placeholder="{{trans('app.message_to_supplier')}}"></textarea>
                </div>

                <!--MENSJE-->
                <div class="itemForm icon-help">
                    <label>@lang('app.to_gtalents_platform')</label>
                    <textarea name="message_gtalents" id="message_gtalents" cols="30" rows="10" placeholder="{{trans('app.message_to_gtalents_platform')}}"></textarea>
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
                            @lang('app.continue')
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

    <!--MODAL NUEVO COLABORADOR-->
    @include('dashboard_user.team.partials.modalcreate')

    <!--MODAL NUEVO CANDIDATO-->
    <?php $dataFile = 'create'; ?>
    @include('dashboard_user.candidate.partials.modalcreate')

@stop

@section('scripts')
  <!--  <script>
        var labels = {!! json_encode(array_keys($activities)) !!};
        var activities = {!! json_encode(array_values($activities)) !!};
    </script>
    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-default.js') !!}-->

    <script>
        $(document).ready(function(){
            $('body').on('change','.change-status',function(){
                vacancy = $(this).attr('value');
                status = $(this).val();
                element = $(this);
                pare = $(this).parent();
                if($(this).val()==4 || $(this).val()==2){
                    $('#modalChangeStatus').modal('open');
                    $('#status_change').val(status);
                    $('#vacancy_change').val(vacancy);
                    /*swal({
                        title: "{{trans('app.are_you_sure')}}",
                        text: "{{trans('app.are_you_sure_change_status')}}",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{trans('app.continue')}}",
                        closeOnConfirm: false
                    },
                    function(){
                        $.ajax({
                            url: "{{route('vacancies.change_status')}}",
                            method: "POST",
                            data: '_token={{csrf_token()}}&status='+status+'&vacancy='+vacancy,
                            success: function(data){
                                pare.append('<p>{{trans('app.status')}}:<span class="label label-warning">'+data.status+'</span></p>');
                                element.remove();
                                swal("{{trans('app.success')}}", "{{trans('app.status_changed')}}", "success");
                            }
                        });
                    });*/
                } else if($(this).val()=='edit'){
                    location.replace('/vacancies/'+vacancy+'/edit');
                }
            });

            $('body').on('click','.change-status',function(e){
                e.preventDefault();
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

            $('#search-supplier-m').keyup(function(){
                if($(this).val().length>=2){
                    $('#list-supplier-m > li').show();
                    value = $(this).val().toLowerCase();
                    $('#list-supplier-m > li').each(function() {
                        var title = $(this).find('.datos h3').html().toLowerCase();
                        var subtitle = $(this).find('.datos p').html().toLowerCase();
                        if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                            $(this).hide();
                        }
                    });
                } else {
                    $('#list-supplier-m > li').show();
                }
            });

            $('#search-candidates-m').keyup(function(){
                if($(this).val().length>=2){
                    $('#list-candidates-m > li').show();
                    value = $(this).val().toLowerCase();
                    $('#list-candidates-m > li').each(function() {
                        var title = $(this).find('.datos h3').html().toLowerCase();
                        var subtitle = $(this).find('.datos p').html().toLowerCase();
                        if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                            $(this).hide();
                        }
                    });
                } else {
                    $('#list-candidates-m > li').show();
                }
            });
        });

        $("#formCreateCollaborator").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                level_of_access: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: "{{trans('app.candidate_validate.first_name_required')}}",
                    minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                },
                last_name: {
                    required: "{{trans('app.candidate_validate.last_name_required')}}",
                    minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                },
                email: {
                    required: "{{trans('app.candidate_validate.email_required')}}",
                    email: "{{trans('app.candidate_validate.email_valid')}}"
                },
                level_of_access: {
                    required: "{{trans('app.collaborator_validate.level_required')}}",
                }
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

        $('.formCreateCollaborator').each(function () {
            $(this).validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3
                    },
                    last_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    level_of_access: {
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: "{{trans('app.candidate_validate.first_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                    },
                    last_name: {
                        required: "{{trans('app.candidate_validate.last_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                    },
                    email: {
                        required: "{{trans('app.candidate_validate.email_required')}}",
                        email: "{{trans('app.candidate_validate.email_valid')}}"
                    },
                    level_of_access: {
                        required: "{{trans('app.collaborator_validate.level_required')}}",
                    }
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
        });

        $("#formCreate").validate({
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                company: {
                    required: true,
                }
            },
            messages: {
                first_name: {
                    required: "{{trans('app.candidate_validate.first_name_required')}}",
                    minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                },
                last_name: {
                    required: "{{trans('app.candidate_validate.last_name_required')}}",
                    minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                },
                email: {
                    required: "{{trans('app.candidate_validate.email_required')}}",
                    email: "{{trans('app.candidate_validate.email_valid')}}"
                },
                company: {
                    required: "{{trans('app.candidate_validate.company_required')}}",
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

        $('.formCreate').each(function(){
            $($(this)).validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3
                    },
                    last_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    company: {
                        required: true,
                    }
                },
                messages: {
                    first_name: {
                        required: "{{trans('app.candidate_validate.first_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                    },
                    last_name: {
                        required: "{{trans('app.candidate_validate.last_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                    },
                    email: {
                        required: "{{trans('app.candidate_validate.email_required')}}",
                        email: "{{trans('app.candidate_validate.email_valid')}}"
                    },
                    company: {
                        required: "{{trans('app.candidate_validate.company_required')}}",
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

            $("#formCreateCollaborator").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 3
                    },
                    last_name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    level_of_access: {
                        required: true
                    }
                },
                messages: {
                    first_name: {
                        required: "{{trans('app.candidate_validate.first_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.first_name_length')}}"
                    },
                    last_name: {
                        required: "{{trans('app.candidate_validate.last_name_required')}}",
                        minlength: "{{trans('app.candidate_validate.last_name_length')}}"
                    },
                    email: {
                        required: "{{trans('app.candidate_validate.email_required')}}",
                        email: "{{trans('app.candidate_validate.email_valid')}}"
                    },
                    level_of_access: {
                        required: "{{trans('app.collaborator_validate.level_required')}}",
                    }
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

            $("#formCreateChangeStatus").validate({
                rules: {
                    message_supplier: {
                        required: true
                    },
                    message_gtalents: {
                        required: true
                    }
                },
                messages: {
                    message_supplier: {
                        required: "{{trans('app.required_message_supplier')}}"
                    },
                    message_gtalents: {
                        required: "{{trans('app.required_message_gtalents')}}"
                    }
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
        });
    </script>
@stop