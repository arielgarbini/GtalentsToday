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

            <!--BTN NUEVO COLABORADOR-->
            @if(!in_array($vacancy->id,$userVacancy))
                <div class="btn-section">
                    <a href="#modalParticipar" class="btn-main modal-trigger waves-effect waves-light">
                        @lang('app.interested')
                    </a>
                </div>
            @endif
            @if(count($suppliers)>=3)
                <div class="btn-section">
                    <a href="#modalSendCandidate" id="validate_credits" class="btn-main">
                        @lang('app.send_candidates_credits')
                    </a>
                </div>
            @endif
            @if(in_array($vacancy->id,$userVacancy))
                <?php
                    $notification = \Vanguard\Notification::where('element_id', $vacancy->id)
                        ->where('user_id', Auth::user()->id)->get()->first();
                ?>
            @if($notification)
            <div class="btn-section">
                <form action="{{route('vacancies.approbate.supplier.invited',$notification->element_id)}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$notification->id}}" name="notification">
                    <input type="hidden" value="{{$notification->user_id}}" name="supplier">
                    <button class="btn-main" type="submit">
                        @lang('app.accept_invitation')
                    </button>
                </form>
            </div>
                @endif
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
                            <h4>{{$userCategorie->supplier_percent}}% @lang('app.of_commission')</h4>
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
            <form action="{{route('vacancies.post_supplier', $vacancy->id)}}" id="form-participate" class="formLogin" method="POST">
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
                        <button class="btn-main" type="button" id="btn-modalMain">
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


  <!--MODAL PARTICIPAR-->
  <div id="modalSendCandidate" class="modal modal-userRegistered">

      <div class="modal-header">
          <!--CERRAR MODAL-->
          <div class="close">
              <a href="#!" class="modal-action modal-close">
                  <span class="icon-gTalents_close-2"></span>
              </a>
          </div>
          <h4>@lang('app.choose_candidate')</h4>
      </div>

      <div class="modal-content">
          <strong>@lang('app.available_credits')</strong> {{\Vanguard\Balance::where('company_id', \Auth::user()->company_user->company_id)->sum('credit')}}<br>
          <strong>@lang('app.cost_send_candidate')</strong> {{$credits_candidates}}
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
              <form id="send-candidate-apply" action="{{route('vacancies.postulate.candidate', $vacancy->id)}}" method="POST" class="formLogin select-colab">
                  {{csrf_field()}}
                  <input type="hidden" name="typ" value="1">
                  <ul class="team" id="list-candi">
                      <!-- SUPPLIER 1 -->
                      @foreach($userCandidatesAvailable as $candidate)
                          <li>
                              <p class="check">
                                  <input type="radio" id="test{{$candidate['id']}}" name="candidates" class="user-candidates"  value="{{$candidate['id']}}"/>
                                  <label for="test{{$candidate['id']}}"></label>
                              </p>
                              <section class="team-card" style="width: 80% !important;">
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

                  <div class="itemForm icon-help">
                      <label>@lang('app.write_your_comment')</label>
                      <textarea name="comment" id="" cols="30" rows="10" placeholder="{{trans('app.write_your_comment')}}"></textarea>
                  </div>

                  <div class="send-colab">
                      <!--href="#modalSendColab"-->
                      <a id="send-candidate" class="waves-effect waves-light">
                          @lang('app.send_candidate')
                      </a>
                  </div>
              </form>
          </div>
      </div>
  </div>
@stop

@section('scripts')
    <script>
    $('#btn-modalMain').click(function(){
        setTimeout(sendForm, 4000);
    });

    function sendForm(){
        $('#form-participate').submit();
    }

    $(document).ready(function(){
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
                    timer: 4000,
                    showConfirmButton: false,
                    type: "error"
                });
                e.preventDefault();
                e.stopPropagation();
                return false;
            } else {
                $('#send-candidate-apply').submit();
            }
        });

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

        $('#validate_credits').click(function(r){
            credits_company = "{{\Vanguard\Balance::where('company_id', \Auth::user()->company_user->company_id)->sum('credit')}}";
            credits_candidates = "{{$credits_candidates}}";
            if(parseFloat(credits_candidates) > parseFloat(credits_company)){
                swal({
                    title: "{{trans('app.error')}}",
                    text: "{{trans('app.error_message_send_candidates_money')}}",
                    timer: 4000,
                    showConfirmButton: false,
                    type: "error"
                });
                setTimeout(function () {
                    window.location = "{{route('credits.index')}}";
                }, 3500);
                r.preventDefault();
                r.stopPropagation();
                return false;
            } else {
                $('#modalSendCandidate').modal('open');
            }
        })
    })
    </script>
@stop
