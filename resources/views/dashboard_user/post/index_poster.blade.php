@extends('layouts.app1')

@section('page-title', trans('app.opportunity'))

@section('content')

    <!-- LISTADO DE POST-->
    <article class="postList-contain grid">
        <!--POST LIST FILTRADO-->
        <article class="postList-contain-filter no-mobile">
            <form action="{{route('vacancies.list','poster')}}" method="GET" class="formLogin" id="formSearch">
                <h3> @lang('app.filter_your_search')</h3>

                <!--BUSQUEDA-->
                <div class="itemForm">
                    <input @if(isset($data['search'])) value="{{$data['search']}}" @endif name="search" id="search" type="text" placeholder="{{trans('app.what_are_you_looking_for')}}" class="input-search">
                </div>

                <!--COMISION-->
            <!--
                <div class="itemForm">
                    <label>@lang('app.comission')</label>
                    <select class="browser-default">
                        <option value="1" selected>USD 25/hora</option>
                        <option value="2">Sra.</option>
                        <option value="3">Dr.</option>
                    </select>
                </div>
-->
                <!--UBICACION-->
                <div class="itemForm">
                    <label>@lang('app.location')</label>
                    <input name="location" type="text" id="location" @if(isset($data['location'])) value="{{$data['location']}}" @endif>
                </div>

                <!--INDUSTRIA-->
                <div class="itemForm">
                    <label>@lang('app.industry')</label>
                    <select name="industry" class="browser-default" id="industry">
                        <option value="" @if(!isset($data['industry']) || $data['industry'] == '') selected @endif>@lang('app.select')</option>
                        @foreach($industries as $key=>$value)
                            <option @if(isset($data['industry']) && $data['industry'] == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <!--TITULO-->
            <!--                <div class="itemForm">
                    <label>@lang('app.title')</label>
                    <select class="browser-default">
                        <option value="1" selected>Sales Director</option>
                        <option value="2">Sra.</option>
                        <option value="3">Dr.</option>
                    </select>
                </div>
-->
                <!--PERIODOS-->
                <div class="itemForm">
                    <label>@lang('app.periods')</label>
                    <select name="periods" class="browser-default" id="periods">
                        <option value="" @if(!isset($data['periods']) || $data['periods'] == '') selected @endif>@lang('app.select')</option>
                        <option @if(isset($data['periods']) && $data['periods'] == 1) selected @endif value="1">@lang('app.yesterday')</option>
                        <option @if(isset($data['periods']) && $data['periods'] == 3) selected @endif value="3">@lang('app.last') 3 @lang('app.days')</option>
                        <option @if(isset($data['periods']) && $data['periods'] == 7) selected @endif value="7">@lang('app.last') 7 @lang('app.days')</option>
                        <option @if(isset($data['periods']) && $data['periods'] == 15) selected @endif value="15">@lang('app.last') 15 @lang('app.days')</option>
                        <option @if(isset($data['periods']) && $data['periods'] == 30) selected @endif value="30">@lang('app.last') 30 @lang('app.days')</option>
                        <option @if(isset($data['periods']) && $data['periods'] == 60) selected @endif value="60">@lang('app.last') 60 @lang('app.days')</option>
                    </select>
                </div>

                <!--SUBMIT-->
                <div class="submit">
                    <button type="submit" class="btn-main2">@lang('app.search')</button>
                </div>
            </form>
        </article>


        <!--LISTADO DE POST-->
        <article class="credits">
            <!--TITULO DE LA SECCION-->
            <section class="credits-title">
                <h3>{{trans('app.do_you_have')}} <strong> {{$vacanciesCount}} {{trans('app.opportunities')}}</strong> {{trans('app.available')}}</h3>
                <!--FILTRADO DE ORDEN-->
                <div class="orderFilter">
                    <label>@lang('app.order_for')</label>
                    <select class="browser-default" id="order">
                        <option value="created_at" @if(!isset($data['order']) || (isset($data['order']) && $data['order'] == 'created_at')) selected @endif>@lang('app.date')</option>
                    <!--<option value="2">@lang('app.comission')</option>-->
                        <option @if(isset($data['order']) && $data['order'] == 'industry') selected @endif value="industry">@lang('app.industry')</option>
                        <option @if(isset($data['order']) && $data['order'] == 'location') selected @endif value="location">@lang('app.location')</option>
                        <option @if(isset($data['order']) && $data['order'] == 'positions_number') selected @endif value="positions_number">@lang('app.positions')</option>
                        <option @if(isset($data['order']) && $data['order'] == 'suppliers_cant') selected @endif value="suppliers_cant">@lang('app.supplier_cant')</option>
                    <!--<option value="7">@lang('app.positions_state')</option>-->
                    </select>
                </div>
            </section>


        @if (count($vacancies))
            <!--LISTADO DE CREDITOS-->
                <ul class="credits-container post-list">
                    <!-- OPORTUNIDAD 1 -->
                    @foreach ($vacancies as $vacancy)
                        <li>
                            <a href="{{route('vacancies.show', $vacancy->id)}}" class="link-listado">
                                <!--RESUMEN OPORTUNIDAD-->
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
                                    </div>
                                    <!--RESUMEN DEL POST-->
                                    <div class="item">
                                        <!--VISITAS-->
                                        <div class="item-option">
                                            <h4><?php echo $viewed->search(['vacancy_id' => $vacancy->id])->count() ?></h4>
                                            <span class="opt-sm">@lang('app.visits')</span>
                                        </div>

                                        <!--CANDIDATOS-->
                                        <div class="item-option">
                                            <h4>{{$vacancy->countCandidatesByStatus('Active')}}</h4>
                                            <span class="opt-sm">@lang('app.candidates')</span>
                                        </div>

                                        <!--POR ACEPTAR-->
                                        <div class="item-option">
                                            <h4>{{$vacancy->countCandidatesByStatus('Unconfirmed')}}</h4>
                                            <span class="opt-sm">@lang('app.to_be_accepted')</span>
                                        </div>
                                    </div>
                                </section>
                            </a>
                        </li>
                    @endforeach
                </ul>
            {{$vacancies->links()}}
            <!--
            <ul class="pagination">
                <li class="disabled">
                    <a href="#!">
                        <span class="icon-gTalents_left"></span>
                    </a>
                </li>
                <li class="active"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
                <li class="waves-effect"><a href="#!">4</a></li>
                <li class="waves-effect"><a href="#!">5</a></li>
                <li class="waves-effect">
                    <a href="#!">
                        <span class="icon-gTalents_right"></span>
                    </a>
                </li>
            </ul>-->
            @endif
        </article>
    </article>

    <!--EQUIPO Y CANDIDATOS MOBILE-->
    <article class="team-mobile">
        <!--BOTON-->
        <a class="team-mobile-btn" id="btn-teamMobile">
            <span class="icon-gTalents_search"></span>
        </a>

        <!--TEAM GROUP-->
        <section class="team-mobile-container" id="teamMobile-container">
            <!--POST LIST FILTRADO-->
            <article class="postList-contain-filter">

            </article>
        </section>
    </article>

@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#order').change(function(){
                location.href = $('#formSearch').attr('action')+'?search='+$('#search').val()+'&location='+$('#location').val()+'&industry='+$('#industry').val()+'&periods='+$('#periods').val()+'&order='+$(this).val();
            });

            $('.change-status').change(function(){
                vacancy = $(this).attr('value');
                status = $(this).val();
                element = $(this);
                pare = $(this).parent();
                if($(this).val()==4 || $(this).val()==2){
                    swal({
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
                        });
                } else if($(this).val()=='edit'){
                    location.replace('/vacancies/'+vacancy+'/edit');
                }
            });

            $('.change-status').click(function(e){
                e.preventDefault();
            });
        });
    </script>
@stop
