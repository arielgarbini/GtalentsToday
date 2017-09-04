@extends('layouts.app1')

@section('page-title', trans('app.post'))

@section('content')


    <!--CREAR NUEVO POST-->
    <article class="newPost grid">
        <!--ENCABEZADO ICONOS-->
        <section class="newPost-legend">
            <!--CREAR-->
            <div class="item active" id="indi-create">
                <figure>
                    <span class="icon-gTalents_crear"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>
                </figure>
                <p>@lang('app.create')</p>
            </div>

            <!--DETALLES-->
            <div class="item" id="indi-detail">
                <figure>
                    <span class="icon-gTalents_detalles"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span></span>
                </figure>
                <p>@lang('app.details')</p>
            </div>

            <!--EMPEZAR-->
            <div class="item" id="indi-go">
                <figure>
                    <span class="icon-gTalents_empezar"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span></span>
                </figure>
                <p>@lang('app.start')</p>
            </div>
        </section>
    @if($vacancy!=false)
        {!! Form::open(['route' => ['vacancies.store', $vacancy->id], 'files' => true, 'id' => 'vacancy-form', 'class'=>'formLogin' , 'method' => 'post', 'enctype'=>'multipart/form-data'] ) !!}
    @else
    {!! Form::open(['route' => 'vacancies.store', 'files' => true, 'id' => 'vacancy-form', 'class'=>'formLogin' , 'method' => 'post', 'enctype'=>'multipart/form-data'] ) !!}
    @endif
        <!-- estatus post activo-->
            <input type="hidden" value="<?= csrf_token() ?>" name="_token">
              
            <!-- CREAR - CONTENEDOR -->
            <section class="newPost-container" id="crear-container">
                <!--NOMBRE DE LA POSICION-->
                <div class="dual">
                    <div class="itemForm">
                        <label for="name">@lang('app.name_position')</label>
                    {!! Form::text('name', ($vacancy!=false) ? $vacancy->name : old('name') , ['id' => 'name', 'class' => 'form-control', 'placeholder' => trans('app.name_position')]) !!}
                             @if($errors->has('name'))
                              <p class="text-darger" style="color:red;"> {{ $errors->first('name') }}</p>
                              @endif
                    </div>
                    <!--NUMERO DE POSICIONES-->
                    <div class="itemForm">
                        <label for="positions_number">@lang('app.positions_number')</label>
                        {!! Form::input('number','positions_number',($vacancy!=false) ? $vacancy->positions_number : null, ['min'=>1, 'id' => 'positions_number','class' => 'solo-numero form-control','placeholder' => trans('app.positions_number')]) !!}
                        @if($errors->has('positions_number'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('positions_number') }}</p>
                        @endif
                    </div>
                </div>

                <div class="dual">
                    <!--UBICACION-->
                    <div class="itemForm itemFormTriple">
                        <label for="location">@lang('app.choose_country')</label>
                        {!! Form::select('country_id', $countries , ($vacancy!=false) ? $vacancy->country_id : null, ['message' => trans('app.state_required'), 'class' => 'browser-default', 'id' => 'country_id', 'placeholder' => trans('app.choose_country')]) !!}
                          @if($errors->has('country_id'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('country_id') }}</p>
                         @endif
                    </div>

                    <div class="itemForm itemFormTriple">
                        <label for="location">@lang('app.choose_province')</label>
                        {!! Form::select('state_id', [] , ($vacancy!=false) ? $vacancy->state_id : null, ['disabled' => true, 'message' => trans('app.state_required'), 'class' => 'browser-default', 'id' => 'state_id', 'placeholder' => trans('app.choose_province')]) !!}
                        @if($errors->has('state_id'))
                            <p class="text-darger" style="color:red;"> {{ $errors->first('state_id') }}</p>
                        @endif
                    </div>

                    <div class="itemForm itemFormTriple">
                        <label for="location">@lang('app.choose_city')</label>
                        {!! Form::select('city_id', [] , ($vacancy!=false) ? $vacancy->city_id : null, ['disabled' => true, 'message' => trans('app.state_required'), 'class' => 'browser-default', 'id' => 'city_id', 'placeholder' => trans('app.choose_city')]) !!}
                    </div>
                </div>

                <!--RESPONSABILIDADES-->
                <div class="itemForm">
                    <label for="responsabilities">@lang('app.responsabilities')</label>
                    {!! Form::textarea('responsabilities', ($vacancy!=false) ? $vacancy->responsabilities : null, ['id' => 'responsabilities', 'class' => 'form-control','placeholder' => trans('app.responsabilities') ])!!}
                   @if($errors->has('responsabilities'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('responsabilities') }}</p>
                    @endif   
                </div>

                <!--EXPERIENCIA REQUERIDA-->
                <div class="itemForm">
                    <label for="required_experience">@lang('app.required_experience')</label>
                    {!! Form::textarea('required_experience', ($vacancy!=false) ? $vacancy->required_experience : null, ['id' => 'required_experience', 'class' => 'form-control','placeholder' => trans('app.required_experience') ]) !!}
                    @if($errors->has('required_experience'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('required_experience') }}</p>
                    @endif 
                </div>

                <!--PREGUNTAS CLAVES-->
                <div class="itemForm icon-help">
                    <label for="key_position_questions">@lang('app.key_position_questions')</label>
                    <a class="hint--right  hint--large hint--bounce" aria-label="{{trans('app.write_the_key_questions')}}">
                        <i class="icon-gTalents_help "></i>
                    </a>
                    {!! Form::textarea('key_position_questions', ($vacancy!=false) ? $vacancy->key_position_questions : null, ['id' => 'key_position_questions', 'class' => 'form-control','placeholder' => '3 puntos o preguntas claves de la posición' ])!!}
                  @if($errors->has('key_position_questions'))
                          <p class="text-darger" style="color:red;"> {{ $errors->first('key_position_questions') }}</p>
                    @endif 
                </div>

                <!--EMPLESAS OBJETIVOS-->
                <div class="itemForm">
                    <div class="row">
                        <div class="col s6">
                            <label for="target_companies">@lang('app.target_companies')</label>
                            {!! Form::textarea('target_companies', ($vacancy!=false) ? $vacancy->target_companies : null, ['id' => 'target_companies', 'class' => 'form-control','placeholder' => trans('app.companies_where_the_candidate_has_worked') ])!!}
                            @if($errors->has('target_companies'))
                                <p class="text-darger" style="color:red;"> {{ $errors->first('target_companies') }}</p>
                            @endif
                        </div>
                        <div class="col s6">
                            <label for="off_limits_companies">@lang('app.off_limits_companies')</label>
                            {!! Form::textarea('off_limits_companies', ($vacancy!=false) ? $vacancy->off_limits_companies : null, ['id' => 'off_limits_companies', 'class' => 'form-control','placeholder' => trans('app.off_limits_companies') ])!!}
                            @if($errors->has('off_limits_companies'))
                                <p class="text-darger" style="color:red;"> {{ $errors->first('off_limits_companies') }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!--EMPLESAS OFF-LIMITS-->
                <div class="itemForm">
                </div>

                <!--BOTONES UPLOAD-->
                <div class="upload">
                    <!-- DESCRIPCION DEL PUESTO -->
                    <div class="box">
                     <!--   <input type="file" name="file" id="file-4" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />-->
                    {!! Form::file('job', ['id' => 'file-4', 'class' => 'inputfile inputfile-2','data-multiple-caption' => '{count} files selected ' ,'multiple'=> true ])!!}
                     <label for="file-4"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>
                        @if($vacancy!=false && $vacancy->file_job_description!='')
                            {{count(explode('&&',$vacancy->file_job_description))>1 ? explode('&&',$vacancy->file_job_description)[1] : $vacancy->file_job_description}}
                        @else
                             @lang('app.job_Description')
                        @endif
                     </span></label>
                    
                    </div>

                    <!-- ACUERDO CON EL EMPLEADOR -->
                    <div class="box hint--bottom  hint--large hint--bounce" aria-label="Acuerdo de confidencialidad entre usted y gTalents, sin este acuerdo podremos invalidar su post">
                       <!-- <input type="file" name="file-2[]" id="file-2" class="inputfile inputfile-2" data-multiple-caption="{count} files selected" multiple />-->
                        {!! Form::file('employer', ['id' => 'file-2', 'class' => 'inputfile inputfile-2','data-multiple-caption' => '{count} files selected ' , 'multiple' => true ])!!}
                        <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>
                                @if($vacancy!=false && $vacancy->file_employer!='')
                                    {{count(explode('&&',$vacancy->file_employer))>1 ? explode('&&',$vacancy->file_employer)[1] : $vacancy->file_employer}}
                                @else
                                    @lang('app.agreement_with_the_Employer')
                                @endif
                            </span></label>
                        
                    </div>
                </div>

                <div class="btn-container">
                    <div class="item">
                       <!-- <a href="#" class="btn-main" id="next-newPost1">Siguiente </a>-->
                        @if($vacancy!=false)
                            <a href="{{route('vacancies.show', $vacancy->id)}}" class="btn-main next " >@lang('app.cancel')</a>
                        @else
                            <a href="{{route('dashboard')}}" class="btn-main next " >@lang('app.cancel')</a>
                        @endif
                        <button type="submit" class="btn-main next " >@lang('app.next')</button>
                        <button type="submit" name="saveonly" value="true" class="btn-main next " >@lang('app.save')</button>
                    </div>
                </div>
            </section>

    
         

            <!--EMPEZAR - CONTAINER -->
            <!--<section class="newPost-container" id="go-container">
       
                <div class="messageWin">
                    <figure>
                        <span class="icon-gTalents_win-2"></span>
                    </figure>
                    <p>Has creado una nueva oportunidad</p>

                    <div class="btn-container">
                       
                        <div class="item">
                            <a href="{{URL::to('post_detail')}}" class="btn-main">Ver Oportunidad</a>
                        </div>
                    </div>
                </div>
            </section>-->
        {!! Form::close() !!}  
    </article>
    

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
  <!--  {!! JsValidator::formRequest('Vanguard\Http\Requests\Vacancy\CreateVacancyRequest', '#vacancy-form') !!}-->

  <script>
      $(document).ready(function(){
          @if($vacancy!=false && $vacancy->country_id!='')
            $.ajax({
              method: "GET",
              url: "{{route('country.getProvince')}}?country={{$vacancy->country_id}}",
              success: function(response){
                  var html = '<option value="">{{trans('app.choose_province')}}</option>';
                  for(var i = 0; i<response.length; i++){
                      html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                  }
                  $('#state_id').html(html);
                  $('#state_id').attr('disabled', false);
                  @if($vacancy!=false && $vacancy->state_id!='')
                    $('#state_id').val("{{$vacancy->state_id}}");
                    $.ajax({
                      method: "GET",
                      url: "{{route('country.getCities')}}?state={{$vacancy->state_id}}",
                      success: function(response){
                          var html = '<option value="">{{trans('app.choose_city')}}</option>';
                          for(var i = 0; i<response.length; i++){
                              html += '<option value="'+response[i].id+'">'+response[i].name+'</option>';
                          }
                          $('#city_id').html(html);
                          $('#city_id').attr('disabled', false);
                          $('#city_id').val("{{$vacancy->city_id}}");
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
