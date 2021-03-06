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
                    <label>@lang('app.choose_country')</label>
                    {!! Form::select('country_id', $countries , (isset($data['country_id'])) ? $data['country_id'] : null, ['class' => 'browser-default', 'id' => 'country_id', 'placeholder' => trans('app.choose_country')]) !!}
                </div>

                <div class="itemForm">
                    <label>@lang('app.choose_province')</label>
                    {!! Form::select('state_id', [] , null, ['disabled'=> true, 'class' => 'browser-default', 'id' => 'state_id', 'placeholder' => trans('app.choose_province')]) !!}
                </div>

                <div class="itemForm">
                    <label>@lang('app.choose_city')</label>
                    {!! Form::select('city_id', [] , null, ['disabled'=> true, 'class' => 'browser-default', 'id' => 'city_id', 'placeholder' => trans('app.choose_city')]) !!}
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
                <ul class="credits-container post-list" id="latesVacanciesUser">
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
                @if($vacancies_users_pages>1)
                    <ul class="pagination" data-pages="{{$vacancies_users_pages}}" data-element="latesVacanciesUser" data-resource="{{route('vacancies.get.find')}}/poster" data-count="{{$vacancies_users_count}}" data-page="1">
                        <li class="disabled" data-page="last"><span>«</span></li>
                        <li class="active page-1" data-page="1" ><span>1</span></li>
                        @for($j = 2; $j<=$vacancies_users_pages; $j++)
                            <li data-page="{{$j}}" class="page-{{$j}}"><span>{{$j}}</span></li>
                        @endfor
                        <li class="disabled" data-page="next"><span>»</span></li>
                    </ul>
                @endif

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

@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('#order').change(function(){
                location.href = $('#formSearch').attr('action')+'?search='+$('#search').val()+'&location='+$('#location').val()+'&industry='+$('#industry').val()+'&periods='+$('#periods').val()+'&order='+$(this).val();
            });

            $('body').on('change', '.change-status', function(){
                vacancy = $(this).attr('value');
                status = $(this).val();
                element = $(this);
                pare = $(this).parent();
                if($(this).val()==4 || $(this).val()==2){
                    $('#modalChangeStatus').modal('open');
                    $('#status_change').val(status);
                    $('#vacancy_change').val(vacancy);
                } else if($(this).val()=='edit'){
                    location.replace('/vacancies/'+vacancy+'/edit');
                }
            });

            $('body').on('click', '.change-status', function(e){
                e.preventDefault();
            });

            @if(isset($data['country_id']) && $data['country_id']!='')
 $.ajax({
                method: "GET",
                url: "{{route('country.getProvince')}}?country={{$data['country_id']}}",
                success: function(response){
                    var html = '<option value="">{{trans('app.choose_province')}}</option>';
                    for(var i = 0; i<response.length; i++){
                        html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                    }
                    $('#state_id').html(html);
                    $('#state_id').attr('disabled', false);
                    @if(isset($data['state_id']) && $data['state_id']!='')
                      $('#state_id').val("{{$data['state_id']}}");
                    $.ajax({
                        method: "GET",
                        url: "{{route('country.getCities')}}?state={{$data['state_id']}}",
                        success: function(response){
                            var html = '<option value="">{{trans('app.choose_city')}}</option>';
                            for(var i = 0; i<response.length; i++){
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#city_id').html(html);
                            $('#city_id').attr('disabled', false);
                            @if(isset($data['city_id']) && $data['city_id']!='')
                                $('#city_id').val("{{$data['city_id']}}");
                            @endif
                        }
                    });
                    @endif
                }
            });
            @endif
          $('#country_id').change(function(){
                if($(this).val()!=''){
                    var country = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "{{route('country.getProvince')}}?country="+country,
                        success: function(response){
                            var html = '<option value="">{{trans('app.choose_province')}}</option>';
                            for(var i = 0; i<response.length; i++){
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#state_id').html(html);
                            $('#state_id').attr('disabled', false);
                        }
                    });
                } else {
                    $('#state_id').val('');
                    $('#city_id').val('');
                    $('#state_id').attr('disabled', true);
                    $('#city_id').attr('disabled', true);
                }
            });

            $('#state_id').change(function(){
                if($(this).val()!=''){
                    var state = $(this).val();
                    $.ajax({
                        method: "GET",
                        url: "{{route('country.getCities')}}?state="+state,
                        success: function(response){
                            var html = '<option value="">{{trans('app.choose_city')}}</option>';
                            for(var i = 0; i<response.length; i++){
                                html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                            }
                            $('#city_id').html(html);
                            $('#city_id').attr('disabled', false);
                        }
                    });
                } else {
                    $('#city_id').val('');
                    $('#city_id').attr('disabled', true);
                }
            });
        });
    </script>
@stop
