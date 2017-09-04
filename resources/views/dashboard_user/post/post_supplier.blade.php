@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')
    <!--CONTENEDOR INDEX REGISTRADO-->
    <article class="user-main grid">
        <!--OPORTUNIDAD-->
        <section class="user-main-create credits jobs-detail">
            <!--TITULO-->
            <div class="jobs-detail-title">
                <h3>{{$vacancy->name}}
                    @if (!empty($success))
                        {{ $success }}
                    @endif
                </h3>
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
                    @if($vacancy->language_id == 1)
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

            <!-- RESUMEN -->
            <div class="bills">
                <!--TITULO DE LA SECCION-->
                <section class="bills-title">
                    <h3>@lang('app.opportunities')</h3>
                </section>

                <!--CIRCULO RESUMEN-->
                <div class="item-circle">
                    <figure>
                        <h4>{{$viewed}}</h4>
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
                            <p>{{count($userCandidatesAvailable)}} @lang('app.candidates')</p>

                            <div class="search-opt1 btn-search">
                                <span class="icon-gTalents_search"></span>
                            </div>                          
                        </div>

                        <!-- SECCION DE BUSQUEDA -->
                        <form class="active-two">
                            <input type="text" placeholder="{{trans('app.name_candidates')}}" id="search-candi">
                            <!--CERRAR SEGMENTO-->
                            <div class="close btn-closeInput">
                                <span class="icon-gTalents_close"></span>
                            </div>                          
                        </form>
                    </section>
                    
                    <!--LISTADO DE EQUIPO-->
                    <form action="" class="formLogin select-colab">
                        <ul class="team" id="list-candi">
                            <!-- SUPPLIER 1 -->
                            @foreach($userCandidatesAvailable as $candidate)
                                <li>
                                    <p class="check">
                                        <input type="checkbox" id="test{{$candidate['id']}}" class="user-candidates"  value="{{$candidate['id']}}"/>
                                        <label for="test{{$candidate['id']}}"></label>
                                    </p>
                                    <section class="team-card">
                                        <!--PERSONA-->
                                        <div class="team-card-person">
                                            <div class="datos">
                                                <h3>{{substr($candidate['first_name'].' '.$candidate['last_name'], 0, 20)}}</h3>
                                                <p>{{substr($candidate['actual_position'], 0, 20)}}</p>
                                            </div>
                                        </div>

                                        <!--OPCIONES-->
                                        <div class="options">
                                            <!-- Dropdown Trigger -->
                                            <a class='dropdown-button' href='#' data-activates='option-team{{$candidate['id']}}'>
                                                <span class="icon-gTalents_submenu"></span>
                                            </a>

                                            <!-- Dropdown Structure -->
                                            <ul id='option-team{{$candidate['id']}}' class='dropdown-content'>
                                                @if($candidate['file']!='')
                                                    <li><a href="/upload/docs/{{$candidate['file']}}" class="cv_candidate" target="_blank">@lang('app.view_cv')</a></li>
                                                @else
                                                    <li><a href="#">@lang('app.view_cv')</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </section>
                                </li>
                            @endforeach
                        </ul>

                        <div class="send-colab">
                            <!--href="#modalSendColab"-->
                            <a id="send-candidate" class="waves-effect waves-light">
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
                            <p>{{count($userCandidatesProgress)}} @lang('app.candidates')</p>

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
                        @foreach($userCandidatesProgress as $candidate)
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
                                            <li><a class="cv_candidate" href="/upload/docs/{{$candidate['file']}}" target="_blank">@lang('app.view_cv')</a></li>
                                        @else
                                            <li><a href="#">@lang('app.view_cv')</a></li>
                                        @endif
                                        <!-- href="#modalHistorico" -->
                                        <li class="open-modal-history" value="{{$candidate['id']}}"><a class="waves-effect waves-light">@lang('app.historical')</a></li>
                                    <!--<li><a href="#">@lang('app.discard')</a></li>-->
                                    </ul>
                                </div>
                            </section>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- RECHAZADOS -->
                <div class="team-container g-general" id="noLeidos">
                    <!-- RESUMEN-->
                    <section class="team-container-tools">
                        <!-- ACTIVO 1 -->
                        <div class="active-one">
                            <p>{{count($userCandidatesRejected)}} @lang('app.not_read')</p>

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
                        @foreach($userCandidatesRejected as $candidate)
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
                                            <li><a href="/upload/docs/{{$candidate['file']}}" target="_blank">@lang('app.view_cv')</a></li>
                                        @else
                                            <li><a href="#">@lang('app.view_cv')</a></li>
                                        @endif
                                        <li><a href="#modalHistorico" class="modal-trigger waves-effect waves-light">@lang('app.historical')</a></li>
                                        <li><a href="#modalNota" class="modal-trigger waves-effect waves-light">@lang('app.view_note')</a></li>
                                    </ul>
                                </div>
                            </section>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>
    </article>


    <!--MODAL NUEVO CANDIDATO-->
    <?php $dataFile = 'create'; ?>
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

            <h4>@lang('app.send_candidates')</h4>
        </div>

        <div class="modal-content">

            <!--RESPUESTA-->
            <form action="{{route('vacancies.postulate.candidate', $vacancy->id)}}" method="POST" class="formLogin">
                <!--SLIDER DE CANDIDATOS SELECCIONADOS-->
                {{csrf_field()}}
                <div class="slider">
                    <ul class="slides slides-candidates">
                        <!-- CANDIDATO 1-->
                    </ul>
                </div>
                <!--MENSAJE-->
                <div class="itemForm icon-help">
                    <label>@lang('app.write_your_comment')</label>
                    <textarea name="comment" id="" cols="30" rows="10" placeholder="{{trans('app.write_your_comment')}}"></textarea>
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
                        <button type="submit" class="btn-main" type="submit" id="btn-modalMain">
                            @lang('app.send')
                        </button>
                    </div>
                </section>
            </form>

            <!--MENSAJE DE COLABORADOR CARGADO-->
            <div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>@lang('app.candidates_send_success')</p>
            </div>
            <!--MENSAJE DE COLABORADOR CARGADO-->
            <!--<div class="messageModal">
                <figure>
                    <span class="icon-gTalents_win-53"></span>
                </figure>
                <p>Candidatos enviados exitosamente</p>
                <!--BTN-MAIN-->
                <!--<div class="item">
                    <a href="#!" class="btn-main">
                        Continuar
                    </a>
                </div>
            </div>-->
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

                </ul>
                <section class="buttonsMain">
                    <!--REGRESAR-->
                    <div class="item">
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-return">
                            @lang('app.back')
                        </a>
                    </div>
                </section>
            </form>
        </div>
    </div>
@stop

@section('scripts')
   <script>
   $(document).ready(function(){

       $('#search-candi').keyup(function(){
           if($(this).val().length>=2){
               $('#list-candi > li').show();
               value = $(this).val().toLowerCase();
               $('#list-candi > li').each(function() {
                   var title = $(this).find('.datos h3').html().toLowerCase();
                   var subtitle = $(this).find('.datos p').html().toLowerCase();
                   if(title.indexOf(value)==-1 && subtitle.indexOf(value)==-1){
                       $(this).hide();
                   }
               });
           } else {
               $('#list-candi > li').show();
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
                   $('.historial-status').html(html);
                   $('#modalHistorico').modal('open');
               }
           });
       });

       $('#send-candidate').click(function(e){
           var candidates = new Array;
           $('.user-candidates').each(function(){
                if($(this).is(':checked')){
                    candidates.push({id:$(this).val(), name: $(this).parent().parent().find('.datos h3').html(),
                        position: $(this).parent().parent().find('.datos p').html(),
                        cv: $(this).parent().parent().find('.cv_candidate').attr('href')});
                }
           });
           if(candidates.length==0){
               swal({
                   title: "{{trans('app.error')}}",
                   text: "{{trans('app.error_message_send_candidates')}}",
                   timer: 2000,
                   showConfirmButton: false,
                   type: "error"
               });
           } else {
                var html = '';
                var ids = new Array;
                for(var i = 0; i<candidates.length; i++) {
                    console.log(candidates[i].cv);
                    html += '<li><div class="profile-colab"><section class="team-card"><div class="team-card-person">';
                    html += '<figure><span class="icon-gTalents_team-48"></span></figure><div class="datos"><h3>' + candidates[i].name + '</h3>';
                    html += '<p>' + candidates[i].position + '</p></div></div><div class="link">';
                    if(candidates[i].cv!=undefined){
                        html += '<a href="'+candidates[i].cv+'" target="_blank"><span class="icon-gTalents_download"></span></a>';
                    } else {
                        html += '<a href="#"><span class="icon-gTalents_download"></span></a>';
                    }
                    html += '</div></section></div></li>';
                    ids.push(candidates[i].id);
                }
                html += '<input type="hidden" value="'+ids.toString()+'" name="candidates">';
                $('.indicators').remove();
                $('.slides-candidates').html(html);
                $('.slider').slider({full_width: true});
                $('#modalSendColab').modal('open');
           }
       });
   });
   </script>
@stop
