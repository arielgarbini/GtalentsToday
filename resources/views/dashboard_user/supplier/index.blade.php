@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')

 
    <!-- LISTADO DE POST-->
    <article class="postList-contain grid">
        <!--POST LIST FILTRADO-->
        <article class="postList-contain-filter filter-supplier no-mobile">
            <form action="{{route('supplier.index')}}" method="GET" class="formLogin" id="formSearch">
                <h3>@lang('app.filter_your_search')</h3>
                <input type="hidden" name="vacancy" value="{{$data['vacancy']}}">
                <!--BUSQUEDA-->
                <div class="itemForm">
                    <input @if(isset($data['search'])) value="{{$data['search']}}" @endif name="search" id="search" type="text" placeholder="{{trans('app.what_are_you_looking_for')}}" class="input-search">
                </div>

                <!--COMISION-->
                <div class="itemForm">
                    <label>@lang('app.functional_area')</label>
                    <select class="browser-default" name="functional" id="functional">
                        <option value="" @if(!isset($data['functional']) || $data['functional'] == '') selected @endif>@lang('app.select')</option>
                        @foreach($functionalArea as $key=>$value)
                            <option @if(isset($data['functional']) && $data['functional'] == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
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

                <!--NIVELES DE POSICION-->
                <!--<div class="itemForm">
                    <label>Niveles de posición</label>
                    <select class="browser-default">
                        <option value="1" selected>Posición</option>
                        <option value="2">Sra.</option>
                        <option value="3">Dr.</option>
                    </select>
                </div>-->

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

                <!--CALIFICACION-->
                <!--<div class="itemForm">
                    <label>@lang('app.qualification')</label>
                    <select class="browser-default" name="qualification" id="qualification">
                        <option value="" @if(!isset($data['qualification']) || $data['qualification'] == '') selected @endif>@lang('app.select')</option>
                        @foreach($qualification as $key=>$value)
                            <option @if(isset($data['qualification']) && $data['qualification'] == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>-->

                <!--NIVEL-->
                <div class="itemForm">
                    <label>@lang('app.category')</label>
                    <select class="browser-default" name="category" id="category">
                        <option value="" @if(!isset($data['category']) || $data['category'] == '') selected @endif>@lang('app.select')</option>
                        @foreach($categories as $key=>$value)
                            <option @if(isset($data['category']) && $data['category'] == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <!--TAMAÑO DE ORGANIZACION-->
                <div class="itemForm">
                    <label>@lang('app.size_company')</label>
                    <select name="employees" class="browser-default" id="employees">
                        <option value="" @if(!isset($data['employees']) || $data['employees'] == '') selected @endif>@lang('app.select')</option>
                        @foreach($quantityEmployees as $key=>$value)
                            <option @if(isset($data['employees']) && $data['employees'] == $key) selected @endif value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <!--SUBMIT-->
                <div class="submit">
                    <button type="submit" class="btn-main2">@lang('app.search') Supplier</button>
                </div>
            </form>
        </article>


        <!--LISTADO DE POST-->
        <article class="credits">
            <!--TITULO DE LA SECCION-->
            <section class="credits-title">
                <h3>{{trans('app.do_you_have')}} <strong>{{$suppliersCount}} Suppliers</strong> {{trans('app.available')}}</h3>

            </section>

            <!--LISTADO DE CREDITOS-->
            @if (count($suppliers))
            <ul class="supplier-container supplier-list" id="latesVacanciesUser">
                <!-- OPORTUNIDAD 1 -->
                @foreach ($suppliers as $supplier)
                <li>
                    <a href="#">
                        <!--RESUMEN OPORTUNIDAD-->
                        <section class="supplierContain1">
                            <!--ICONO RANGO-->
                            <figure class="supplierContain1-ranking">
                                <img class="category-p " src="/upload/categories/{{$supplier->company[0]->category->avatar}}" data-position="bottom" data-delay="50" data-tooltip="{{$supplier->company[0]->category->name}}">
                            </figure>

                            <div class="datos">
                                <h4>{{$supplier->code}}</h4>
                                <p>{{$supplier->company[0]->category->name}}</p>
                            </div>
                        </section>
                    </a>

                    <!--AGREGAR SUPPLIER-->
                    <div class="add-supplier">
                        <!--PERFIL-->
                        <div class="link">
                            <a modal="modalProfileSupplier{{$supplier->id}}" href="#" class="will-smith">
                                <span class="icon-gTalents_profile"></span>
                            </a>
                        </div>

                        <!--AGREGAR SUPPLIER-->
                        <div class="link">
                            <form method="POST" action="{{route('vacancies.invited.supplier', $data['vacancy'])}}">
                                {{csrf_field()}}
                                <input type="hidden" value="{{$supplier->id}}" name="supplier">
                                <a href="#" class="send_form">
                                    <span class="icon-gTalent_add-supplier"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></span>
                                </a>
                            </form>
                        </div>
                    </div>
                    @include('dashboard_user.post.partials.modalsupplier')
                </li>
                @endforeach
            </ul>
                @if($suppliers_users_pages>1)
                    <ul class="pagination" data-pages="{{$suppliers_users_pages}}" data-element="latesVacanciesUser" data-resource="{{route('suppliers.get.find')}}" data-count="{{$suppliers_users_count}}" data-page="1">
                        <li class="disabled" data-page="last"><span>«</span></li>
                        <li class="active page-1" data-page="1" ><span>1</span></li>
                        @for($j = 2; $j<=$suppliers_users_pages; $j++)
                            <li data-page="{{$j}}" class="page-{{$j}}"><span>{{$j}}</span></li>
                        @endfor
                        <li class="disabled" data-page="next"><span>»</span></li>
                    </ul>
                @endif
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
            <article class="postList-contain-filter filter-supplier">
                <form action="" class="formLogin">
                    <h3>Filtra tu búsqueda</h3>

                    <!--BUSQUEDA-->
                    <div class="itemForm">
                        <input type="text" placeholder="¿Qué buscas?" class="input-search">
                    </div>

                    <!--COMISION-->
                    <div class="itemForm">
                        <label>Áreas funcionales</label>
                        <select class="browser-default">
                            <option value="1" selected>Gerencia</option>
                            <option value="2">Sra.</option>
                            <option value="3">Dr.</option>
                        </select>
                    </div>

                    <!--INDUSTRIA-->
                    <div class="itemForm">
                        <label>Industria</label>
                        <select class="browser-default">
                            <option value="1" selected>Diseño e Informática</option>
                            <option value="2">Sra.</option>
                            <option value="3">Dr.</option>
                        </select>
                    </div>

                    <!--NIVELES DE POSICION-->
                    <div class="itemForm">
                        <label>Niveles de posición</label>
                        <select class="browser-default">
                            <option value="1" selected>Posición</option>
                            <option value="2">Sra.</option>
                            <option value="3">Dr.</option>
                        </select>
                    </div>

                    <!--UBICACION-->
                    <div class="itemForm">
                        <label>Ubicación</label>
                        <input type="text" placeholder="Caracas - Venezuela">
                    </div>

                    <!--CALIFICACION-->
                    <div class="itemForm">
                        <label>Calificación</label>
                        <select class="browser-default">
                            <option value="1" selected>5 estrellas</option>
                            <option value="2">Calificacion</option>
                        </select>
                    </div>

                    <!--NIVEL-->
                    <div class="itemForm">
                        <label>Nivel</label>
                        <select class="browser-default">
                            <option value="1" selected>Hiring Pro</option>
                            <option value="2">Hiring Pro</option>
                            <option value="3">Hiring Pro</option>
                        </select>
                    </div>

                    <!--TAMAÑO DE ORGANIZACION-->
                    <div class="itemForm">
                        <label>Tamaño de Organización</label>
                        <select class="browser-default">
                            <option value="1" selected>tamaño</option>
                            <option value="2">tamaño</option>
                            <option value="3">tamaño</option>
                        </select>
                    </div>

                    <!--SUBMIT-->
                    <div class="submit">
                        <button type="submit" class="btn-main2">Buscar Supplier</button>
                    </div>
                </form>
            </article>
        </section>
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
            <article class="postList-contain-filter filter-supplier">
                <form action="" class="formLogin">
                    <h3>Filtra tu búsqueda</h3>

                    <!--BUSQUEDA-->
                    <div class="itemForm">
                        <input type="text" placeholder="¿Qué buscas?" class="input-search">
                    </div>

                    <!--COMISION-->
                    <div class="itemForm">
                        <label>Áreas funcionales</label>
                        <select class="browser-default">
                            <option value="1" selected>Gerencia</option>
                            <option value="2">Sra.</option>
                            <option value="3">Dr.</option>
                        </select>
                    </div>

                    <!--INDUSTRIA-->
                    <div class="itemForm">
                        <label>Industria</label>
                        <select class="browser-default">
                            <option value="1" selected>Diseño e Informática</option>
                            <option value="2">Sra.</option>
                            <option value="3">Dr.</option>
                        </select>
                    </div>

                    <!--NIVELES DE POSICION-->
                    <div class="itemForm">
                        <label>Niveles de posición</label>
                        <select class="browser-default">
                            <option value="1" selected>Posición</option>
                            <option value="2">Sra.</option>
                            <option value="3">Dr.</option>
                        </select>
                    </div>

                    <!--UBICACION-->
                    <div class="itemForm">
                        <label>Ubicación</label>
                        <input type="text" placeholder="Caracas - Venezuela">
                    </div>

                    <!--CALIFICACION-->
                    <div class="itemForm">
                        <label>Calificación</label>
                        <select class="browser-default">
                            <option value="1" selected>5 estrellas</option>
                            <option value="2">Calificacion</option>
                        </select>
                    </div>

                    <!--NIVEL-->
                    <div class="itemForm">
                        <label>Nivel</label>
                        <select class="browser-default">
                            <option value="1" selected>Hiring Pro</option>
                            <option value="2">Hiring Pro</option>
                            <option value="3">Hiring Pro</option>
                        </select>
                    </div>

                    <!--TAMAÑO DE ORGANIZACION-->
                    <div class="itemForm">
                        <label>Tamaño de Organización</label>
                        <select class="browser-default">
                            <option value="1" selected>tamaño</option>
                            <option value="2">tamaño</option>
                            <option value="3">tamaño</option>
                        </select>
                    </div>

                    <!--SUBMIT-->
                    <div class="submit">
                        <button type="submit" class="btn-main2">Buscar Supplier</button>
                    </div>
                </form>
            </article>
        </section>
    </article>

@stop

@section('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('click','.will-smith',function(e){
               $('#'+$(this).attr('modal')).modal('open');
                e.preventDefault();
            });

            $('#order').change(function(){
                location.href = $('#formSearch').attr('action')+'?search='+$('#search').val()+'&location='+$('#location').val()+'&industry='+$('#industry').val()+'&periods='+$('#periods').val()+'&order='+$(this).val();
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